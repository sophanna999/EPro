<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
class AuthController extends Controller
{

    public function register(){
        $data['title_page']   = 'Customer Register';
        $data['main_menu']    = 'customer_register';
        $data['submenu_menu'] = '';
        $data['name_title']   = \App\Models\Prefixe::get();
        return view('customer.register',$data);
    }
    
    public function login(){
        $data['title_page']   = 'Customer Login';
        $data['main_menu']    = 'customer_login';
        $data['submenu_menu'] = '';
        $data['conditions']   = \App\Models\Condition::where('type', 'C')->first();
        $data['name_title']   = \App\Models\Prefixe::get();
    	return view('customer.login',$data);
    }
    public function CheckRegister(Request $request){
            $prefix_id  = $request->input('prefix_id');
            $firstname  = $request->input('firstname');
            $lastname   = $request->input('lastname');
            $mobile     = $request->input('mobile');
            $email      = $request->input('email');
            $password   = $request->input('password');
            $input      = $request->all();
                $validator  = Validator::make($request->all(), [
                    'firstname' => 'required',
                    'lastname'  => 'required',
                    'mobile'    => 'required',
                    'email'     => 'required|email',
                    'password'  => 'required'
        ]);
        if (!$validator->fails()) {
        	$check_dup = \App\User::where('email',$email)->first();
        	if(!$check_dup){
        		\DB::beginTransaction();
	            try {
	                $data_insert = [
                        'type_id'         => 'C',
                        'prefix_id'       => $prefix_id,
                        'firstname'       => $firstname,
                        'lastname'        => $lastname,
                        'mobile'          => $mobile,
                        'email'           => $email,
                        'status'          => 'WA',
                        'check_condition' => 'T',
                        'check_promotion' => 'T',
                        'created_at'      => date('Y-m-d H:i:s'),
                        'updated_at'      => date('Y-m-d H:i:s'),
                        'password'        => \Hash::make($password)
	                ];
                    $id    = \App\User::insertGetId($data_insert);
                    $token = str_random(40);
                    $token = base64_encode($token.'#'.date('Y-m-d H:i:s').'#'.$email);
                    $input['token'] = $token;
                    \App\Models\TokenActivate::insertGetId([
                        'user_id'       =>  $id,
                        'email'         =>  $email,
                        'token'         =>  $token,
                        'time_register' =>  date('Y-m-d H:i:s'),
                        'created_at'    =>  date('Y-m-d H:i:s'),
                        'updated_at'    =>  date('Y-m-d H:i:s'),
                    ]);
                    \Mail::send('email.customer_register', ['input' => $input], function ($m) use ($input) {
                        $m->from('support@wattprice.com', 'Watt Price Solution');
                        $m->to($input['email'], $input['firstname'])->subject('WattPrice Register');
                    });
	                \DB::commit();
                    $return['status']  = 1;
                    $return['content'] = 'Thank for your registering. Please check your email for verification link!';
	            } catch (Exception $e) {
	                \DB::rollBack();
                    $return['status']  = 0;
                    $return['content'] = 'Error'.$e->getMessage();;
	            }
        	}else{
                $return['status']  = 0;
                $return['content'] = 'The email already exists';
            }
        }else{
            $return['status']  = 0;
            $return['content'] = 'Field Missmath';
        }
        $return['title'] = 'Registered Successfully';
        $return['title_fails'] = 'Register Unsuccessful';
        return json_encode($return);
    }

    public function CheckLogin(Request $request){
    	$email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember',false);
        // $data['submit_quote'] = \App\Models\SubmitQuote::where('customer_id',$user->id)->get();


        $validator = Validator::make($request->all(), [
            'email'    => 'required',
            'password' => 'required'
        ]);

        if (!$validator->fails()) {
        	if(\Auth::guard('customer')->attempt(['email' => $email, 'password' => $password , 'type_id'=>'C' ,'status'=>'A'])){
        	//if(\Auth::guard('customer')->attempt(['email' => 'test@gmail.com', 'password' => '123456789' , 'type_id'=>'C'])){
                $return['status']  = 1;
                $return['content'] = 'Field Missmath';
        	}else{
                $return['status']  = 0;
                $return['content'] = 'WattPrice password are case sensitive. Please check your CAPS Lock key. If you forgot password click forgot password';
        	}
        }else{
            $return['status']  = 0;
            $return['content'] = 'Field Missmath';
        }
        $return['title'] = 'Login Successfully';
        $return['title_fails'] = 'Incorrect Email/Password combination';
        return json_encode($return);
    }

    public function Logout(){
        \Auth::guard('customer')->logout();
        return redirect('Customer/Login');
    }

    public function ActivateRegister($id = null){
        if($id){
            $result = \App\Models\TokenActivate::where('status','A')->where('token',$id)->first();
            if($result){
                \App\Models\TokenActivate::where('id',$result->id)->update(['status'=>'U']);
                \App\User::where('id',$result->user_id)->update(['status'=>'A']);
                // return 'Activated Successful </br><a href="'.url('Customer/Login').'" class="btn-primary btn" type="button">Login Now</a>';
                return redirect('ActivatedEmail');

            }else{
                return 'Link Expired';
            }
        }
    }
    
}
