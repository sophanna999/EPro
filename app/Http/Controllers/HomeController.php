<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;
use Validator;

class HomeController extends Controller
{
    public function index(){
        $data['title_page']     = 'Home';
        $data['main_menu']      = 'home';
        $data['submenu_menu']   = '';
        $data['advertisements'] = \App\Models\Advertisement::orderBy('id', 'DESC')->limit(2)->get();
        $data['knowledges']     = \App\Models\Knowledge::orderBy('id', 'DESC')->limit(2)->get();
    	return view('home',$data);
    }
    public function ActivatedEmail(){
        $data['title_page']     = 'Activated Email';
        $data['main_menu']      = 'Activated Email';
        $data['submenu_menu']   = '';
        return view('activated_email',$data);
    }

    public function CallBackPayment(Request $request)
    {
        $data_test = '{"merchant":"jaycee.feng@wattprice.com.sg","ref_id":"27","reference_code":"1FDA182R29118","response_code":"1","currency":"SGD","total_amount":"0.50","signature":"3499b5e9feab42cf23b55051da2f3ab7decca7be","signatureold":"","signature_algorithm":"sha1","card_type":"Visa","action_type":"pay"}';
        $all_input = json_decode($data_test,true);
        // $all_input = $request->all();
        if($all_input['response_code']==1){
            $secret_key = "3c13001e69e9437f9e89a4464e313dbf"; 
            $merchant = $all_input['merchant'];
            $ref_id = $all_input['ref_id']; 
            $reference_code = $all_input['reference_code']; 
            $response_code = $all_input['response_code']; 
            $currency = $all_input['currency'];
            $total_amount = $all_input['total_amount'];
            $signature = $all_input['signature'];
            $signature_algorithm = $all_input['signature_algorithm'];
            $dataToBeHashed = $secret_key
                            .$merchant
                            .$ref_id
                            .$reference_code
                            .$response_code
                            .$currency
                            .$total_amount;
            $utfString = mb_convert_encoding($dataToBeHashed, "UTF-8");
            $check_signature = sha1($utfString, false);
            //echo $check_signature.' | '.$signature;
            if ($signature == $check_signature) {
                $payment_data = json_encode($all_input);
                $all_data = [
                    'name' => $payment_data,
                    'signature' => $all_input['signature']
                ];
                $user = \Auth::guard('retailer')->user(); 
                \App\Models\CallBackPayment::insert($all_data);
                \Mail::send('email.str_url_mail', ['input' => $all_input], function($message) use ($user)
                {
                    $message->from(env('MAIL_USERNAME') , 'Watt Price Solution');
                    $message->to($user->email, $user->firstname)->subject('New Request');
                });

                $signature = $all_input['signature'];
                $ref_id = $all_input['ref_id'];
                $buy_credit = \App\Models\BuyCredit::where(['id'=>$ref_id,'status'=>'WA'])->first();
                if($buy_credit){
                    $user = \App\User::find($buy_credit->user_id);
                    $new_credit = $user->credit+$buy_credit->credit;
                    \App\User::where('id',$buy_credit->user_id)->update(['credit'=>$new_credit]);
                    \App\Models\BuyCredit::where(['id'=>$ref_id,'status'=>'WA'])->update(['status'=>'A']);
                }
            } else {
                // signature does not matched
                // log for investigation
            }
            //dd($all_input);
            
        }
    }
    public function PaymentSuccess($id)
    {
        $data['title_page']     = 'Payment Successfully';
        $data['main_menu']      = 'PaymentSuccess';
        return view('payment_success', $data);
    }
    public function PaymentCancel($id)
    {
        $data['title_page']     = 'Payment Cancel';
        $data['main_menu']      = 'PaymentCancel';
        return view('payment_cancel',$data);
    }

    public function store(Request $request) {
    	$sub_email = $request->input('sub_email');

        $validator = Validator::make($request->all(), [
            'sub_email' => 'required',
        ]);

        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
            	$check = \App\Models\Subscribe::where('sub_email', $sub_email)->first();
            	if(!$check) {
	                $data_insert = [
                        'sub_email'  =>$sub_email,
                        'created_at' =>date("Y-m-d H:i:s"),
                        'updated_at' =>date("Y-m-d H:i:s"),
	                ];
	                \App\Models\Subscribe::insert($data_insert);
	                \DB::commit();
                    $return['STATUS']  = 1;
                    $return['CONTENT'] = 'Success';
            	} else {
                    $return['STATUS']  = 0;
                    $return['CONTENT'] = 'Unsuccess, Have this email';
            	}
            } catch (Exception $e) {
                \DB::rollBack();
                $return['STATUS']  = 0;
                $return['CONTENT'] = 'Unsucces'.$e->getMessage();
            }
        }else{
            $return['STATUS'] = 0;
        }
        $return['TITLE'] = 'Subscribe';
        return json_encode($return);
    }

    public function advertisements($id){
        $data['title_page']     = 'Home';
        $data['main_menu']      = 'home';
        $data['submenu_menu']   = '';
        $data['advertisements']     = \App\Models\Advertisement::find($id);
        return view('advertisements',$data);
    }
}
