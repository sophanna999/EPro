<?php

namespace App\Http\Controllers\Retailer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Mail;

class CreditController extends Controller
{
    public function index(){

        
        $data['title_page']     = 'Credit';
        $data['main_menu']      = 'retailer';
        $data['submenu_menu']   = '';
        $data['id']             = 1;
        $data['user']           = \Auth::guard('retailer')->user();
        $data['credit_data']    = \App\Models\Credit::orderBy('updated_at','desc')->paginate(5);
        $user                   = \Auth::guard('retailer')->user();
        $user_id                = $user->id;
        $credit                 = $user->credit;
        $data['credits']        = $credit;
        $data['pending_credit'] = \App\Models\Pending_Credit::where('retailer_id',$user_id)->sum('credit');
        $data['histories']      = \App\Models\BuyCredit::where('user_id',$user_id)->get();
        // dd($data['pending_credit']);
    	return view('retailer.credit',$data);
    }
    public function get_credit($id){
    	$data['title_page']    = 'Puchase Form';
    	$data['main_menu']     = 'retailer';
    	$data['submenu_menu']  = '';
        $data['credit_data']   = \App\Models\Credit::find($id);
    	$data['user']          = \Auth::guard('retailer')->user();
    	return view('retailer.purchase_credit',$data);
    }
    public function purchase(Request $request){

    	$user_id      	= $request->input('user_id');
        $credit_id    	= $request->input('credit_id');
        $credit       	= $request->input('credit');
        $price    		= $request->input('price');
        $input = $request->all();
        // $photo      	= $request->input('photo')[0];

        $validator  = Validator::make($request->all(), [
            // 'photo'     => 'required',
        ]);
        if (!$validator->fails()) {
            $user    = \Auth::guard('retailer')->user();
            $user_id = $user->id;
            return $user->email;
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'user_id'       =>  $user_id,
                    'credit_id'     =>  $credit_id,
                    'credit'        =>  $credit,
                    'price'         =>  $price,
                    'file_name'     =>  '',
                    'created_at'   	=>  date('Y-m-d H:i:s'),
                    'status'   		=>  "WA",
                ];
                \App\Models\BuyCredit::insert($data_insert);
                \Mail::send('email.str_url_mail', ['input' => $input], function($message) use ($user)
                    {
                        $message->from(env('MAIL_USERNAME') , 'Watt Price Solution');
                        $message->to($user->email, $user->firstname)->subject('New Request');
                    });
                \DB::commit();
                $return['status']   = 1;
                $return['content']  = 'Successful';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status']   = 0;
                $return['content']  = 'Unsuccessful'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'Purcahsed';
        return json_encode($return);
    }
    public function BuyCreditWithSmoovPay(Request $request){
        $id = $request->input('id');
        $input = $request->all();
        if($id){
            $credit = \App\Models\Credit::find($id);
            $user = \Auth::guard('retailer')->user();
            $dataToBeHashed = '3c13001e69e9437f9e89a4464e313dbf'
                  . 'jaycee.feng@wattprice.com.sg'
                  . 'pay'
                  . $id
                  . $credit->price
                  . 'SGD';
          $utfString = mb_convert_encoding($dataToBeHashed, "UTF-8");
          $signature = sha1($utfString, false); 
            $data = [
                'user_id'=>$user->id,
                'credit_id'=>$id,
                'credit'=>$credit->credit,
                'price'=>$credit->price,
                'status'=>'WA',
                'signature'=>$signature,
                'created_at'=>date('Y-m-d h:i:s'),
            ];
            $ref_id = \App\Models\BuyCredit::insertGetId($data);
            \Mail::send('email.str_url_mail', ['input' => $input], function($message) use ($user)
                {
                    $message->from(env('MAIL_USERNAME') , 'Watt Price Solution');
                    $message->to($user->email, $user->firstname)->subject('Buy Credit');
                });
            $ch = curl_init();
            //curl_setopt($ch, CURLOPT_URL,"https://staging-secure.smoovpay.com/redirecturl");
            curl_setopt($ch, CURLOPT_URL,"https://secure.smoovpay.com/redirecturl");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,
                        ["version"=>"2.0",
                        "action"=>"pay",
                        "merchant"=>"jaycee.feng@wattprice.com.sg",
                        "ref_id"=>$ref_id,
                        "item_name_1"=>"Buy Credit",
                        "item_description_1"=>"Buy Credit Watt Price",
                        "item_quantity_1"=>$credit->credit,
                        "item_amount_1"=>($credit->price/$credit->credit),
                        "currency"=>"SGD",
                        "total_amount"=>$credit->price,
                        "signature"=>$signature,
                        "signature_algorithm"=>'sha1',
                        "str_url"=>'http://workbythaidev.com/ect/electricity/public/api/CallBackPayment',
                        "success_url"=>"http://workbythaidev.com/ect/electricity/public/api/PaymentSuccess/".$ref_id,
                        "cancel_url"=>"http://workbythaidev.com/ect/electricity/public/api/PaymentCancel/".$ref_id
                        ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $server_output = curl_exec ($ch);

            curl_close ($ch);
            return $server_output;
        }
        
    }

}
