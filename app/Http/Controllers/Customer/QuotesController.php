<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;

class QuotesController extends Controller
{
    public function index(Request $request){
        $page                 = $request->input('page',1);
        $item_per_page        = 5;
        $type_id              = $request->input('type_id',null);
        $keyword              = $request->input('keyword');
        $data['title_page']   = 'Submitted Quote';
        $data['main_menu']    = 'customer';
        $data['submenu_menu'] = '';
        $data['id']           = (($page-1)*$item_per_page)+1;
        $user                 = \Auth::guard('customer')->user();
        $data['user']         = $user;
        $data['type_id']      = $type_id;
        $data['keyword']      = $keyword;
        // dd($user->id);
        if ($keyword == null) {
            if ($type_id == null) {
                    $data['lists'] = \App\Models\Requests::MyRequest($user->id)
                    ->where('status', 'O')
                    ->orderBy('created_at', 'DESC')
                    // ->get();
                    ->paginate($item_per_page);    
            }else{
                // $submit_reject = \App\Models\SubmitQuote::where('customer_id',$user->id)->update(['status'=>'r']);
                $data['lists'] = \App\Models\Requests::MyRequest($user->id)
                ->where('type_id', $type_id)
                ->where('status', 'O')
                ->orderBy('created_at', 'DESC')
                ->paginate($item_per_page);
            }
            
        }else{
            if ($type_id == null) {
                // $submit_reject = \App\Models\SubmitQuote::where('customer_id',$user->id)->update(['status'=>'r']);
                $data['lists']   = \App\Models\Requests::where('customer_id',$user->id)->where('random_request_id','like', '%' .$keyword. '%')
                ->orwhere('premise_address','like', '%' .$keyword. '%')
                ->orderBy('created_at', 'DESC')->paginate($item_per_page);
            }else {
                // $submit_reject = \App\Models\SubmitQuote::where('customer_id',$user->id)->update(['status'=>'r']);
                $data['lists']   = \App\Models\Requests::where('customer_id',$user->id)->where('type_id', $type_id)
                ->where(function($q) use($keyword){
                    $q->orWhere('random_request_id','like', '%' .$keyword. '%');
                    $q->orWhere('premise_address','like', '%' .$keyword. '%');
                })
                ->orderBy('created_at', 'DESC')->paginate($item_per_page);
            }
        }
    	return view('customer.quotes',$data);
    }

    public function submittedQuote($id){    
        $data['title_page']   = 'Submitted Quote List';
        $data['main_menu']    = 'customer';
        $data['submenu_menu'] = '';
        $data['id']           = 1;
        $sp_tariff            = \App\Models\SpTariff::first();
        $data['sp_tariff']    = $sp_tariff;
        $data['user']         = \Auth::guard('customer')->user();
        // $submit_quotes     = \App\Models\SubmitQuote::with('User','Quotation')
        $submit_quotes        = \App\Models\SubmitQuote::leftjoin('users','submit_quotes.retailer_id','=','users.id')
        ->leftjoin('quotes','submit_quotes.quotes_id','=','quotes.id')
        ->leftjoin('quote_promotions','quotes.id','=','quote_promotions.quote_id')
        ->leftjoin('post_request','submit_quotes.request_id','=','post_request.request_id')
        ->leftjoin('request_estimate','submit_quotes.request_estimate_id','=','request_estimate.id')
        ->leftjoin('estimate_commencement','request_estimate.estimate_id','=','estimate_commencement.id')
        ->leftjoin('dwelling_type','post_request.dwelling_type_id','=','dwelling_type.id')
        ->where('submit_quotes.request_id', $id)
        // ->where('quotes.request_id', $id)
        // ->where('quotes.status', 'S')
        ->select('users.*','submit_quotes.*','quotes.*','post_request.*','request_estimate.*','quote_promotions.title','quote_promotions.images','estimate_commencement.*','quotes.price as qprice','dwelling_type.dwe_name', 'dwelling_type.dwe_detail')
        ->get();
        //$data['submited_quote']     = $submit_quotes;
         // dd($submit_quotes);
        foreach ($submit_quotes as $val) {
            if($val->type_id=="1"){//Business
                if($val->type=="D"){
                    $percent    = $val->peak;
                }else{
                    $a       = $sp_tariff->value;
                    $saving  = $a - $val->peak;
                    $percent = ceil((($saving/$a)*100));
                }
            }else{
                if($val->type=="D"){
                    $percent    = $val->qprice;
                }else{
                    $a       = $sp_tariff->value;
                    $saving  = $a - $val->qprice;
                    $percent = ceil((($saving/$a)*100));
                }
            }
            $data['submited_quote'][$percent][] = $val;    
        }

        if($data['submited_quote']){
            krsort($data['submited_quote']);
        }
        // dd($data['submited_quote']);

        // dd($data['submited_quote']);
        // if(isset($data['submited_quote'])){
        //         ksort($data['submited_quote']);
        //  }else{
        //      $data['submited_quote'] = null;
        //  }
      // dd($data['submited_quote']);
      if($data['submited_quote']) {
        return view('customer.submitted_quote_lists',$data);
      } else {
        return redirect('Customer/ViewSubmittedQuotes');
      }
    }
    public function submitQuoteDetail($id){

        $data['title_page']          = 'Submitted Quote Detail';
        $data['main_menu']           = 'customer';
        $data['submenu_menu']        = '';
        $data['id']                  = 1;
        $data['user']                = \Auth::guard('customer')->user();
        $data['submit_quote_detail'] = \App\Models\SubmitQuote::leftjoin('post_request','submit_quotes.request_id','=','post_request.request_id')
        ->leftjoin('quotes','submit_quotes.quotes_id','=','quotes.id')
        ->leftjoin('users','submit_quotes.retailer_id','=','users.id')
        ->where('submit_quotes.submit_quotes_id', $id)
        ->first();
        // dd($data['submit_quote_detail']);
    	return view('customer.submitted_quote_detail',$data);

    }

    public function SelectPlanBusiness(Request $request, $id){
        $request_id          = $request->input('request_id');
        $customer_id         = $request->input('customer_id');
        $quote_id            = $request->input('quote_id');
        $retailer_id         = $request->input('retailer_id');
        $date_signup         = $request->input('date_signup');
        $contact_period      = $request->input('contact_period');
        $request_estimate_id = $request->input('request_estimate_id');
        $data                = $request->all();
        $get_photo           = \App\Models\Request_Photo::where('request_id',$request_id)->get();
        if (!empty($request->file('photo_bill1'))) {
            $photo_bill1     = $request->file('photo_bill1');
            $bill_name1      = time().rand().'.'.$photo_bill1->getClientOriginalExtension();
            $destinationPath = public_path('uploads/requests/');
            $photo_bill1->move($destinationPath, $bill_name1);
            if(!empty($get_photo[0])) {
                \App\Models\Request_Photo::where('id',$get_photo[0]->id)->update(['photo_name'=>$bill_name1,'updated_at'=>date('Y-m-d H:i:s')]);
            } else {
                \App\Models\Request_Photo::insert(['request_id'=>$request_id, 'photo_name'=>$bill_name1, 'customer_id'=>$customer_id,'created_at'=>date('Y-m-d H:i:s')]);
            }
        }
        if (!empty($request->file('photo_bill2'))) {
            $photo_bill2     = $request->file('photo_bill2');
            $bill_name2      = time().rand().'.'.$photo_bill2->getClientOriginalExtension();
            $destinationPath = public_path('uploads/requests/');
            $photo_bill2->move($destinationPath, $bill_name2);
            if(!empty($get_photo[1])) {
                \App\Models\Request_Photo::where('id',$get_photo[1]->id)->update(['photo_name'=>$bill_name2,'updated_at'=>date('Y-m-d H:i:s')]);
            } else {
                \App\Models\Request_Photo::insert(['request_id'=>$request_id, 'photo_name'=>$bill_name2, 'customer_id'=>$customer_id,'created_at'=>date('Y-m-d H:i:s')]);
            }
        }
        // if ($request->hasFile('photo_bill1')) {
        //     $photo_bill1     = $request->file('photo_bill1');
        //     $bill_name1      = time().'.'.$photo_bill1->getClientOriginalExtension();
        //     $destinationPath = public_path('uploads/requests/');
        //     $photo_bill1->move($destinationPath, $bill_name1);
        // }
        // if ($request->hasFile('photo_bill2')) {
        //     $photo_bill2      = $request->file('photo_bill2');
        //     $bill_name2       = time().'.'.$photo_bill2->getClientOriginalExtension();
        //     $destinationPath = public_path('uploads/requests/');
        //     $photo_bill2->move($destinationPath, $bill_name2);
        // }
        if ($request->hasFile('photo_id_card')) {
            $photo_id_card   = $request->file('photo_id_card');
            $id_card_name    = time().'.'.$photo_id_card->getClientOriginalExtension();
            $destinationPath = public_path('uploads/requests/');
            $photo_id_card->move($destinationPath, $id_card_name);
        }

        \DB::beginTransaction();
        try {
            $contract = \App\Models\Contract::where('retailer_id', $retailer_id)->first();
            $retailer = \App\Models\User::where('id',$retailer_id)->first();
            // return json_encode($contract);
            $data_update = [
                'date_signup'     =>  $date_signup,
                'contract_period' =>  $contact_period,
                'status'          =>  's',
                'bill_image1'     =>  $bill_name1,
                'bill_image2'     =>  $bill_name2,
                'id_card_image'   =>  $id_card_name,
                'updated_at'      =>  date('Y-m-d H:i:s'),
            ];
            \App\Models\SubmitQuote::where('submit_quotes_id',$id)->update($data_update);

            \Mail::send('email.select_price_plan', $data, function($message) use ($retailer)
            {
                $message->from(env('MAIL_USERNAME') , 'Watt Price Solution');
                $message->to($retailer->email, $retailer->firstname.' '.$retailer->lastname)->subject('Select Price Plan');
            });

            // $result = \App\Models\SubmitQuote::where('request_id',$request_id)->get();
            // foreach ($result as $key => $value) {
            //     if ($value->submit_quotes_id) {
            //         $data_update['status'] = 's';
            //         \App\Models\SubmitQuote::where('submit_quotes_id',$value->submit_quotes_id)->update($data_update);
            //     }else{
            //         $data_update['status'] = 'r';
            //         \App\Models\SubmitQuote::where('submit_quotes_id',$value->submit_quotes_id)->update($data_update);                  
            //     }
            // }
            \App\Models\Requests::where('request_id',$request_id)->update(['status'=>'S','updated_at' => date('Y-m-d H:i:s')]);
            \App\Models\Pending_Credit::where('request_id', $request_id)->where('retailer_id', $retailer_id)->update(['status' => 'S']);

            $request_res = \App\Models\SubmitQuote::where('status','!=', 's')->where('request_id', $request_id)->get();
            foreach($request_res as $key => $val) {
                // $credit = \App\Models\Pending_Credit::where('request_id',$request_id)->where('retailer_id', $val->retailer_id)->first()->credit;
                // $credit += \App\Models\User::where('id', $val->retailer_id)->first()->credit;
                // \App\Models\User::where('id', $val->retailer_id)->update(['credit' => $credit,'updated_at' => date('Y-m-d H:i:s')]);
                $pending_credit = \App\Models\Pending_Credit::where('request_id',$request_id)->where('retailer_id', $val->retailer_id)->first();
                $users_credit   = \App\Models\User::where('id', $val->retailer_id)->first();
                $credit         = $pending_credit->credit;
                $now_credit     = $users_credit->credit;
                $new_credit     = $credit+$now_credit;
                \App\Models\User::where('id', $val->retailer_id)->update(['credit' => $new_credit,'updated_at' => date('Y-m-d H:i:s')]);
                \App\Models\Pending_Credit::where('request_id', $val->request_id)->where('retailer_id', $val->retailer_id)->update(['status' => 'C','updated_at' => date('Y-m-d H:i:s')]);
            }

            \DB::commit();
            $return['status']   = 1;
            $return['content']  = 'Successful';

        } catch (Exception $e) {
            \DB::rollBack();
            $return['status']   = 0;
            $return['content']  = 'Unsuccessful'.$e->getMessage();;
        }
        $return['title'] = 'Quotes Submitted';
        return json_encode($return);
    }
    public function SelectPlanResidetail(Request $request, $id){
        $request_id          = $request->input('request_id');
        $customer_id         = $request->input('customer_id');
        $quote_id            = $request->input('quote_id');
        $retailer_id         = $request->input('retailer_id');
        $date_signup         = $request->input('date_signup');
        $contact_period      = $request->input('contact_period');
        $request_estimate_id = $request->input('request_estimate_id');
        $data                = $request->all();
        $get_photo           = \App\Models\Request_Photo::where('request_id',$request_id)->get();
        if (!empty($request->file('photo_bill1'))) {
            $photo_bill1     = $request->file('photo_bill1');
            $bill_name1      = time().rand().'.'.$photo_bill1->getClientOriginalExtension();
            $destinationPath = public_path('uploads/requests/');
            $photo_bill1->move($destinationPath, $bill_name1);
            if(!empty($get_photo[0])) {
                \App\Models\Request_Photo::where('id',$get_photo[0]->id)->update(['photo_name'=>$bill_name1,'updated_at'=>date('Y-m-d H:i:s')]);
            } else {
                \App\Models\Request_Photo::insert(['request_id'=>$request_id, 'photo_name'=>$bill_name1, 'customer_id'=>$customer_id,'created_at'=>date('Y-m-d H:i:s')]);
            }
        }
        if (!empty($request->file('photo_bill2'))) {
            $photo_bill2     = $request->file('photo_bill2');
            $bill_name2      = time().rand().'.'.$photo_bill2->getClientOriginalExtension();
            $destinationPath = public_path('uploads/requests/');
            $photo_bill2->move($destinationPath, $bill_name2);
            if(!empty($get_photo[1])) {
                \App\Models\Request_Photo::where('id',$get_photo[1]->id)->update(['photo_name'=>$bill_name2,'updated_at'=>date('Y-m-d H:i:s')]);
            } else {
                \App\Models\Request_Photo::insert(['request_id'=>$request_id, 'photo_name'=>$bill_name2, 'customer_id'=>$customer_id,'created_at'=>date('Y-m-d H:i:s')]);
            }
        }
        if ($request->hasFile('photo_id_card')) {
            $photo_id_card   = $request->file('photo_id_card');
            $id_card_name    = time().'.'.$photo_id_card->getClientOriginalExtension();
            $destinationPath = public_path('uploads/requests/');
            $photo_id_card->move($destinationPath, $id_card_name);
        }
        // $photo_bill          = $request->input('photo_bill')[0];
        // $photo_id_card       = $request->input('photo_id_card')[0];
        // if ($request->hasFile('photo_bill')) {
        //     $photo_bill          = $request->file('photo_bill');
        //     $bill_name           = time().'.'.$photo_bill->getClientOriginalExtension();
        //     $destinationPath     = public_path('uploads/bills/');
        //     $photo_bill->move($destinationPath, $bill_name);
        // }
        // if ($request->hasFile('photo_id_card')) {
        //     $photo_id_card   = $request->file('photo_id_card');
        //     $id_card_name    = time().'.'.$photo_id_card->getClientOriginalExtension();
        //     $destinationPath = public_path('uploads/bills/');
        //     $photo_id_card->move($destinationPath, $id_card_name);
        // }
        \DB::beginTransaction();
        try {
            $retailer = \App\Models\User::where('id',$retailer_id)->first();
            $data_update = [
                'date_signup'     =>  $date_signup,
                'contract_period' =>  $contact_period,
                'status'          =>  's',
                // 'bill_image'      =>  $bill_name,
                'bill_image1'     =>  $bill_name1,
                'bill_image2'     =>  $bill_name2,
                'id_card_image'   =>  $id_card_name,
            ];
            \App\Models\SubmitQuote::where('submit_quotes_id',$id)->update($data_update);
            \App\Models\Requests::where('request_id',$request_id)->update(['status'=>'S']);
            \App\Models\Pending_Credit::where('request_id', $request_id)->where('retailer_id', $retailer_id)->update(['status' => 'S']);
            $request_res = \App\Models\SubmitQuote::where('status','!=', 's')->where('retailer_id','!=',$retailer_id)->where('request_id', $request_id)->groupBy('retailer_id')->get();
            // dd($request_res);
            \Mail::send('email.select_price_plan', $data, function($message) use ($retailer)
            {
                $message->from(env('MAIL_USERNAME') , 'Watt Price Solution');
                $message->to($retailer->email, $retailer->firstname.' '.$retailer->lastname)->subject('Select Price Plan');
            });

            foreach($request_res as $key => $val) {
                // $credit = \App\Models\Pending_Credit::where('request_id',$request_id)->where('retailer_id', $val->retailer_id)->first()->credit;
                // $credit += \App\Models\User::where('id', $val->retailer_id)->first()->credit;
                // \App\Models\User::where('id', $val->retailer_id)->update(['credit' => $credit,'updated_at' => date('Y-m-d H:i:s')]);

                $pending_credit = \App\Models\Pending_Credit::where('request_id',$request_id)->where('retailer_id', $val->retailer_id)->first();
                $users_credit   = \App\Models\User::where('id', $val->retailer_id)->first();
                $credit         = $pending_credit->credit;
                $now_credit     = $users_credit->credit;
                $new_credit     = $credit+$now_credit;
                \App\Models\User::where('id', $val->retailer_id)->update(['credit' => $new_credit,'updated_at' => date('Y-m-d H:i:s')]);
                \App\Models\Pending_Credit::where('request_id', $val->request_id)->where('retailer_id', $val->retailer_id)->update(['status' => 'S','updated_at' => date('Y-m-d H:i:s')]);
            }

            \DB::commit();
            $return['status']   = 1;
            $return['content']  = 'Successful';

        } catch (Exception $e) {
            \DB::rollBack();
            $return['status']   = 0;
            $return['content']  = 'Unsuccessful'.$e->getMessage();
        }
        $return['title'] = 'Quotes Submitted';
        return json_encode($return);
    }
    public function SelectChoosePlan($id) {
      $result              = \App\Models\SubmitQuote::with('Quotation','QuotePromotion','User.Contract','Customer','RequestEstimate.EstimateCommencement','Request.RequestPhoto')->find($id);
      $month_amount        = $result->RequestEstimate->EstimateCommencement->count_month;
      $result->count_month = date("Y-m-d",strtotime(1+$month_amount.' month'));
      return json_encode($result);
    }
    public function RejectRequest(Request $request){
        $user         = \Auth::guard('customer')->user();
        $data['user'] = $user;
        // $GetRequest   = \App\Models\Requests::whereNotIn('status',['S','C'])->get();
        $GetSubmitRequest = \App\Models\SubmitQuote::select('submit_quotes.*')->where('deadline','!=', null)->groupBy('retailer_id','request_id','deadline')->get();
        // dd($GetSubmitRequest);
            $i=0;
            $pending_credit = [];
        foreach ($GetSubmitRequest as $key => $value) {
            $toDay    = date('Y-m-d H:i:s');
            $deadline = $value->deadline;
            if ($deadline!=null && $toDay >= $deadline) {
                $i++;
                if(empty($pending_credit[$value->retailer_id])) {
                    $pending_credit[$value->retailer_id] = 0;
                }
                $pending_credit[$value->retailer_id] = \App\Models\Pending_Credit::where('request_id',$value->request_id)->where('retailer_id',$value->retailer_id)->where('status','!=','C')->sum('credit');
                $users_credit   = \App\Models\User::where('id',$value->retailer_id)->first();
                // $credit         = $pending_credit->credit;
                $now_credit     = $users_credit->credit;
                $new_credit     = $pending_credit[$value->retailer_id]+$now_credit;
                \App\Models\User::where('id',$value->retailer_id)->update(['credit'=>$new_credit, 'updated_at'=> date('Y-m-d H:i:s')]);
                \App\Models\Pending_Credit::where('request_id', $value->request_id)->where('retailer_id',$value->retailer_id)->update(['status' => 'C','updated_at' => date('Y-m-d H:i:s')]);
                \App\Models\Requests::where('request_id',$value->request_id)->update(['status'=>'C']);
            }
        }
        // dd($pending_credit);
        // return redirect('Customer/ViewSubmittedQuotes');

    }
}
