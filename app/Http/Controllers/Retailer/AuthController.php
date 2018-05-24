<?php

namespace App\Http\Controllers\Retailer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
class AuthController extends Controller
{
    public function register(){
        $data['title_page']   = 'Retailer Register';
        $data['main_menu']    = 'retailer_register';
        $data['submenu_menu'] = '';
        $data['name_title']   = \App\Models\Prefixe::get();
    	return view('retailer.register',$data);
    }
    public function login(){
        $data['title_page']   = 'Retailer Login';
        $data['main_menu']    = 'retailer_login';
        $data['name_title']   = \App\Models\Prefixe::get();
        $data['conditions']   = \App\Models\Condition::where('type', 'R')->first();
        $data['submenu_menu'] = '';
    	return view('retailer.login',$data);
    }

    public function CheckRegister(Request $request){
        $prefix_id = $request->input('prefix_id');
        $firstname = $request->input('firstname');
        $lastname  = $request->input('lastname');
        $company   = $request->input('company');
        $mobile    = $request->input('mobile');
        $email     = $request->input('email');
        $password  = $request->input('password');
        $input     = $request->all();

        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'company'   => 'required',
            'lastname'  => 'required',
            'email'     => 'required',
            'mobile'    => 'required',
            'password'  => 'required'
        ]);
        if (!$validator->fails()) {
        	$check_dup = \App\User::where('email',$email)->first();
        	if(!$check_dup){
        		\DB::beginTransaction();
	            try {
	                $data_insert = [
                        'type_id'    =>'R',
                        'prefix_id'  =>$prefix_id,
                        'firstname'  =>$firstname,
                        'lastname'   =>$lastname,
                        'company'    =>$company,
                        'email'      =>$email,
                        'mobile'     =>$mobile,
                        'status'     =>'WA',//Fix Code Wait Approve
                        'created_at' => date('Y-m-d H:i:s'),
                        'password'   => \Hash::make($password)
	                ];
	                \App\User::insert($data_insert);
                    \Mail::send('email.retailer_register', ['input' => $input], function ($m) use ($input) {
                        $m->from('support@wattprice.com', 'Watt Price Solution');
                        $m->to($input['email'], $input['firstname'])->subject('WattPrice Register');
                    });
	                \DB::commit();
                    $return['status']  = 1;
                    $return['content'] = 'Register Success Please Wait Admin Approve';
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
        $email    = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember',false);

        $validator = Validator::make($request->all(), [
            'email'    => 'required',
            'password' => 'required'
        ]);
        if (!$validator->fails()) {
            if(\Auth::guard('retailer')->attempt(['email' => $email, 'password' => $password , 'status'=>'A', 'type_id'=>'R'])){
                $return['status']  = 1;
                $return['content'] = 'Field Missmath';
            }else{
                $return['status']  = 0;
                $return['content'] = 'WattPrice password are case sensitive. Please check your CAPS Lock key. If you forgot password click forgot password.';
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
        \Auth::guard('retailer')->logout();
        return redirect('Retailer/Login');
    }
}
