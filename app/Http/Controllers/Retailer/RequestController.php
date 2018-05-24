<?php

namespace App\Http\Controllers\Retailer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\DB;
use Mail;

class RequestController extends Controller
{
    public function index(Request $request){
        $type_id              = $request->input('type_id',null);
        $keyword              = $request->input('keyword');
        $page                 = $request->input('page', 1);
        $item_per_page        = 10;
        $data['title_page']   = 'Request Form';
        $data['main_menu']    = 'retailer';
        $data['submenu_menu'] = '';
        $data['type_id']      = $type_id;
        $data['keyword']      = $keyword;
        $data['id']           = (($page-1)*$item_per_page)+1;
        $user                 = \Auth::guard('retailer')->user();
        $data['user']         = $user;
        if($keyword == null) {
            if ($type_id == null) {
                $data['request_data']  = \App\Models\Requests::with(['SubmitQuote'=>function($q){
                    $id = \Auth::guard('retailer')->user()->id;
                    $q->where('retailer_id',$id);
                }])->whereIn('post_request.status', ['O','S'])
                ->orderBy('created_at','desc')
                ->paginate($item_per_page);
                // ->get();
                // dd($data['request_data']);
            }else {

                $data['request_data']  = \App\Models\Requests::with(['SubmitQuote'=>function($q){
                    $id = \Auth::guard('retailer')->user()->id;
                    $q->where('retailer_id',$id);
                }])->whereIn('post_request.status', ['O','S'])
                ->where('post_request.type_id', $type_id)
                ->orderBy('created_at','desc')
                ->paginate($item_per_page);
            }
        } else {
            if ($type_id==null) {
                $data['request_data']  = \App\Models\Requests::with(['SubmitQuote'=>function($q){
                    $id = \Auth::guard('retailer')->user()->id;
                    $q->where('retailer_id',$id);
                }])->where('premise_address','like', '%' .$keyword. '%')
                ->where('random_request_id','like', '%' .$keyword. '%')
                ->orderBy('created_at', 'DESC')->paginate($item_per_page);
            }else {
                $data['request_data']  = \App\Models\Requests::with(['SubmitQuote'=>function($q){
                    $id = \Auth::guard('retailer')->user()->id;
                    $q->where('retailer_id',$id);
                }])->where('post_request.type_id', $type_id)
                ->where(function($q) use($keyword){
                    $q->orWhere('premise_address','like', '%' .$keyword. '%');
                    $q->orWhere('random_request_id','like', '%' .$keyword. '%');
                })
                ->orderBy('created_at', 'DESC')->paginate($item_per_page);
            }
        }

        // dd($data['request_data']);

        return view('retailer.request',$data);
    }

    public function ViewRequest($id){

        $data['title_page']     = 'View Request';
        $data['main_menu']      = 'retailer';
        $data['submenu_menu']   = '';
        $quotations             = \App\Models\Quotation::get();
        $data['quotation_name'] = $quotations;
        $submitQuote            = \App\Models\SubmitQuote::get();
        $data['status']         = $submitQuote;
        $user                   = \Auth::guard('retailer')->user();
        $data['user']           = $user;
        $data['promotions']     = \App\Models\Promotion::where('status', 'A')->where('retailer_id', $user->id)->get();
        $check_submit           = \App\Models\SubmitQuote::where('retailer_id',$user->id)->where('request_id',$id)->first();
        $data['check_submit']   = $check_submit;
        // dd($data['check_submit']); 
         //$request                 = \App\Models\SubmitQuote::with('Retailer','Quotation','Request.RequestEstimate.EstimateCommencement','Customer')->where('retailer_id',$user->id)->where('request_id',$id)->limit(1)->get();
        //\DB::enableQueryLog();
        $request = \App\Models\Requests::with(['User','RequestEstimate.EstimateCommencement','Dwelling','Existing','RequestEstimate.SubmitQuote','SubmitQuote'=>function($q){
            $user = \Auth::guard('retailer')->user();
            $q->where('retailer_id',$user->id);
        },'RequestEstimate.SubmitQuote.Quotation.QuotePromotion'])->find($id);
        $data['request']    = $request;
        // dd($data['request']);
        $data['submitquote']     = \App\Models\Quotation::where('retailer_id',$user->id)->where('request_id',$request->request_id)->first();
        if($request) {
          return view('retailer.view_request',$data);
      } else {
          return redirect('/Retailer/ViewRequest');
      }
  }
  public function submitquote(Request $request){

    $customer_id         = $request->input('customer_id');
    $request_id          = $request->input('request_id');
    $customer_email      = $request->input('customer_email');
    $customer_name       = $request->input('customer_name');
    $price               = $request->input('price');
    $title               = $request->input('title');
    $detail              = $request->input('detail');
    $promotion           = $request->input('promotion');
    $payment_term_f      = $request->input('payment_term_f');
    $request_estimate_id = $request->input('request_estimate_id');
    $sec_dep_f           = $request->input('sec_dep_f');
    $retailer_charge_f   = $request->input('retailer_charge_f');
    $ami_f               = $request->input('ami_f');
    $bill_charge_f       = $request->input('bill_charge_f');
    $collect_charge_f    = $request->input('collect_charge_f');
    $status              = $request->input('status');
    $photo               = $request->input('photo')[0];

    $data  = $request->all();

    $validator  = Validator::make($request->all(), [
        'payment_term_f'   => 'required',
        'sec_dep_f'        => 'required',
        'ami_f'            => 'required',
        'collect_charge_f' => 'required'
    ]);
    if (!$validator->fails()) {
        $retailer          = \Auth::guard('retailer')->user();
        $retailer_id       = $retailer->id;
        $credit_amount     = $retailer->credit;
        $check_request     = \App\Models\Requests::leftjoin('dwelling_type','post_request.dwelling_type_id','=','dwelling_type.id')->where('request_id',$request_id)->first();
            // $deduct_one_credit = $credit_amount-$check_request->credit_quotes;
        $new_credit        = $credit_amount-$check_request->credit_submit-$check_request->credit_quotes;
        $contract          = \App\Models\Contract::where('retailer_id',$retailer_id)->first();
        // $submitted_request = \App\Models\SubmitQuote::where('request_id',$request_id)->count();
        $submitted_request = \App\Models\SubmitQuote::select(DB::raw('count(retailer_id) as r'))->where('request_id',$request_id)->groupBy('retailer_id')->get();
        // return $credit_amount;
        \DB::beginTransaction();
        try {
            $data_submit_quote = [
                'customer_id' =>  $customer_id,
                'retailer_id' =>  $retailer_id,
                'request_id'  =>  $request_id,
                'status'      =>  'w',
                'created_at'  =>  date('Y-m-d H:i:s'),
            ];
            $data_quotes = [
                'retailer_id'       =>  $retailer_id,
                'request_id'        =>  $request_id,
                'payment_term'      =>  $payment_term_f,
                'ami'               =>  $ami_f,
                'sucurity_deposit'  =>  $sec_dep_f,
                'retailer_charge'   =>  $retailer_charge_f,
                'billing_charge'    =>  $bill_charge_f,
                'collection_charge' =>  $collect_charge_f,
                'status'            =>  'W',
                'created_at'        =>  date('Y-m-d H:i:s'),
            ];

            if (count($submitted_request)<=5) {
                if (count($contract)> 0) {
                    if ($credit_amount > 0) {
                        $credit = $check_request->credit_submit;
                        $status = 'P';
                        $created_at = date('Y-m-d H:i:s');
                        \App\Models\Pending_Credit::insert(['retailer_id'=>$retailer_id,'request_id'=>$request_id,'credit'=>$check_request->credit_submit,'status'=>$status, 'created_at'=>$created_at]);
                        // \App\Models\Requests::where('request_id', $request_id)->update(['status'=>'S']);
                        \App\Models\User::where('id',$retailer_id)->update(['credit'=>$new_credit]);
                        $id = '';
                        $i = 0;
                        foreach ($price as $key => $value) {
                            $data_quotes['price']               = $value;
                            $data_quotes['request_estimate_id'] = $request_estimate_id[$i];
                            $id  = \App\Models\Quotation::insertGetId($data_quotes);
                            $promotion_res = \App\Models\Promotion::find($promotion[$key]);
                            \App\Models\QuotePromotion::insert(['quote_id'=>$id,'promotion_id'=>$promotion[$key],'title'=>$promotion_res->title,'detail'=>$promotion_res->detail,'images'=>$promotion_res->images,'files'=>$promotion_res->files,'created_at'=>date('Y-m-d H:i:s')]);
                            $data_submit_quote['quotes_id'] = $id;
                            if($key == $i) {
                                $data_submit_quote['quotes_id'] = $id;
                                $data_submit_quote['request_estimate_id'] = $request_estimate_id[$i];
                                \App\Models\SubmitQuote::insert($data_submit_quote);
                                $submitQuote_data = \App\Models\SubmitQuote::where('request_id',$request_id)->select('submit_quotes.*')->groupBy('request_id')->get();
                                foreach ($submitQuote_data as $key => $value) {
                                    $date_start    = strtotime($value->created_at);
                                    $next_week     = strtotime("+1 week", $date_start);
                                    $next_week_res = date('Y-m-d H:i:s', $next_week);
                                }
                                \App\Models\SubmitQuote::where('request_id',$request_id)->update(['deadline'=>$next_week_res]);
                            }

                            \Mail::send('email.submit_quote', $data, function($message) use ($customer_email,$customer_name)
                            {
                                $message->from(env('MAIL_USERNAME') , 'Watt Price Solution');
                                $message->to($customer_email, $customer_name)->subject('Submitted quotes');
                            });
                            $i++;
                        }
                        \DB::commit();
                        $return['status']   = 1;
                        $return['content']  = 'Successful';
                        }else{

                                $return['status'] = 2;
                                $return['content'] = 'Your balance is not enought, Please purchase credit first';
                            }
                        }else{

                            $return['status'] = 3;
                            $return['content'] = 'Please create your Contract first';
                        }
                    }else {
                    $return['status'] = 4;
                    $return['content'] = 'Only 5 retailers to submit also, It is 5 person ready!';
                }

        } catch (Exception $e) {
            \DB::rollBack();
            $return['status']   = 0;
            $return['content']  = 'Unsuccessful'.$e->getMessage();;
        }
    }else{
        $return['status'] = 0;
    }
    $return['title'] = 'Submitted Quotation Successfully';
    $return['title_error'] = 'Unsuccessfully Submit Quotation';
    return json_encode($return);
}
public function submitquote_business(Request $request){

    $customer_id_b         = $request->input('customer_id_b');
    $request_id          = $request->input('request_id_b');
    $customer_email        = $request->input('customer_email');
    $customer_name         = $request->input('customer_name');
    $peak                  = $request->input('peak');
    $off_peak              = $request->input('off_peak');
    // $title_fix_b        = $request->input('title_fix_b');
    // $detail_fix_b       = $request->input('detail_fix_b');
    $promotion             = $request->input('promotion');
    $request_estimate_id_b = $request->input('request_estimate_id_b');
    $title_dis_b           = $request->input('title_dis_b');
    $promotion_id_dis_b    = $request->input('promotion_id_dis_b');
    $payment_term_b        = $request->input('payment_term_b');
    $sec_dep_b             = $request->input('sec_dep_b');
    $retailer_charge_b     = $request->input('retailer_charge_b');
    $ami_b                 = $request->input('ami_b');
    $bill_charge_b         = $request->input('bill_charge_b');
    $collect_charge_b      = $request->input('collect_charge_b');
    $photo                 = $request->input('photo')[0];
    $data                  = $request->all();

    $validator  = Validator::make($request->all(), [
        'payment_term_b'   => 'required',
        'sec_dep_b'        => 'required',
        'ami_b'            => 'required'
    ]);
    if (!$validator->fails()) {
        $retailer          = \Auth::guard('retailer')->user();
        $retailer_id       = $retailer->id;
        $credit_amount     = $retailer->credit;
        $check_request     = \App\Models\Requests::leftjoin('dwelling_type','post_request.dwelling_type_id','=','dwelling_type.id')->where('request_id',$request_id)->first();
        // dd($check_request);
        $deduct_one_credit = $credit_amount-$check_request->credit_quotes;
        $new_credit        = $deduct_one_credit-$check_request->credit_submit;
        $contract          = \App\Models\Contract::where('retailer_id',$retailer_id)->first();
        $submitted_request = \App\Models\SubmitQuote::select(DB::raw('count(retailer_id) as r'))->where('request_id',$request_id)->groupBy('retailer_id')->get();
        // $submitted_request = \App\Models\SubmitQuote::where('request_id',$request_id)->count();
            // return json_encode($submitted_request);
            // return json_encode($request_estimate_id);
        \DB::beginTransaction();
        try {
            $data_submit_quote = [
                'customer_id' =>  $customer_id_b,
                'request_id'  =>  $request_id,
                'retailer_id' =>  $retailer_id,
                'status'      =>  'w',
                'created_at'  =>  date('Y-m-d H:i:s'),
            ];
            $data_quotes = [
                'retailer_id'       =>  $retailer_id,
                'request_id'        =>  $request_id,
                'payment_term'      =>  $payment_term_b,
                'ami'               =>  $ami_b,
                'sucurity_deposit'  =>  $sec_dep_b,
                'retailer_charge'   =>  $retailer_charge_b,
                'billing_charge'    =>  $bill_charge_b,
                'collection_charge' =>  $collect_charge_b,
                'status'            =>  'W',
                'created_at'        =>  date('Y-m-d H:i:s'),
            ];

            if (count($submitted_request)<=5) {
                if (count($contract)> 0) {
                    $credit = $check_request->credit_submit != null ? $check_request->credit_submit : '0' ;
                    $status = 'P';
                    $created_at = date('Y-m-d H:i:s');
                    \App\Models\Pending_Credit::insert(['retailer_id'=>$retailer_id,'request_id'=>$request_id,'credit'=>$credit,'status'=>$status, 'created_at'=>$created_at]);

                    // \App\Models\Requests::where('request_id', $request_id)->update(['status'=>'S']);
                    \App\Models\User::where('id',$retailer_id)->update(['credit'=>$new_credit]);
                    $id = '';
                    $i = 0;
                    foreach ($peak as $key => $value) {
                        if($off_peak[$i]!=NULL) {
                            $data_quotes['off_peak']=$off_peak[$i];
                        }
                        $data_quotes['peak']=$value;
                        $data_quotes['request_estimate_id']=$request_estimate_id_b[$i];
                        // $promotion_data = \App\Models\Promotion::where('id',$promotion[$i])->get();
                        $id = \App\Models\Quotation::insertGetId($data_quotes);
                        $promotion_res = \App\Models\Promotion::find($promotion[$key]);
                        \App\Models\QuotePromotion::insert(['quote_id'=>$id,'promotion_id'=>$promotion[$key],'title'=>$promotion_res->title,'detail'=>$promotion_res->detail,'images'=>$promotion_res->images,'files'=>$promotion_res->files,'created_at'=>date('Y-m-d H:i:s')]);
                        $data_submit_quote['quotes_id'] = $id;
                        if($key == $i) {
                            $data_submit_quote['quotes_id'] = $id;
                            $data_submit_quote['request_estimate_id'] = $request_estimate_id_b[$i];
                            \App\Models\SubmitQuote::insert($data_submit_quote);
                            $submitQuote_data = \App\Models\SubmitQuote::where('request_id',$request_id)->select('submit_quotes.*')->groupBy('request_id')->get();
                            // dd($submitQuote_data);
                            foreach ($submitQuote_data as $key => $value) {
                                    $date_start    = strtotime($value->created_at);
                                    $next_week     = strtotime("+1 week", $date_start);
                                    $next_week_res = date('Y-m-d H:i:s', $next_week);
                                }
                            \App\Models\SubmitQuote::where('request_id',$request_id)->update(['deadline'=>$next_week_res]);
                        }
                        \Mail::send('email.submit_quote', $data, function($message) use ($customer_email,$customer_name)
                        {
                            $message->from(env('MAIL_USERNAME') , 'Watt Price Solution');
                            $message->to($customer_email, $customer_name)->subject('Submitted quotes');
                        });
                        $i++;
                    }
                    \DB::commit();
                    $return['status']   = 1;
                    $return['content']  = 'Successful';
                }else{
                    $return['status'] = 0;
                    $return['content'] = 'Please create your "Contract" first';
                }
            }else {
                $return['status'] = 0;
                $return['content'] = 'Only 5 retailers to submit also, It is 5 person ready!';
            }

        } catch (Exception $e) {
            \DB::rollBack();
            $return['status']   = 0;
            $return['content']  = 'Unsuccessful'.$e->getMessage();;
        }
    }else{
        $return['status'] = 0;
    }
    $return['title'] = 'Quotes Submitted';
    return json_encode($return);
}
}
