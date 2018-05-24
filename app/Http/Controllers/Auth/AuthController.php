<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

use App\Http\Requests;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function CallbackFacebook(Request $request){
        $token = $request->input('token');
        $user = \Socialite::driver('facebook')->userFromToken($token);
        $check = User::where('facebook_id',$user->id)->first();
        if(!$check){
            $id = User::insertGetId([
                'facebook_id' => $user->id,
                'type_id' => 'C',
                'firstname' => $user->name,
                'email' => $user->email,
                'created_at' => date('Y-m-d H:i:s'),
                'password' => bcrypt(str_random(15)),
            ]);
        }else{
            $id = $check->id;
        }
        if($id){
            \Auth::guard('customer')->loginUsingId($id);
        }
        return 1;
    }

    public function FaceBookLogin(){
        return \Socialite::driver('facebook')->redirect();
    }

    public function CustomerForgotPassword(){
        $data['title_page']   = 'Forgot Password';
        $data['main_menu']    = '';
        $data['submenu_menu'] = '';
        return view('customer/forgot_password');
    }
    public function RetailerForgotPassword(){
        $data['title_page']   = 'Forgot Password';
        $data['main_menu']    = '';
        $data['submenu_menu'] = '';
        return view('retailer/forgot_password');
    }

    public function CustomerResetPassword($token){
        $data['title_page']   = 'Forgot Password';
        $data['main_menu']    = '';
        $data['submenu_menu'] = '';
        $data['token'] = $token;
        return view('customer/reset_password',$data);
    }
    public function RetailerResetPassword($token){
        $data['title_page']   = 'Forgot Password';
        $data['main_menu']    = '';
        $data['submenu_menu'] = '';
        $data['token'] = $token;
        return view('retailer/reset_password',$data);
    }

    public function CheckForgotPassword(Request $request){
        $input = $request->all();
        $result = User::where('email',$request->input('email'))->where('type_id', 'C')->first();
        $input['token'] = str_random(40);
        User::where('email',$request->input('email'))->update(['reset_password'=>$input['token']]);
        if($result){
            \Mail::send('email.forgot_password', ['input' => $input], function ($m) use ($result) {
                $m->from('support@wattprice.com', 'Watt Price Solution');
                $m->to($result->email, $result->firstname)->subject('WattPrice Forgot Password');
            });
            $data['status'] = 1;
            $data['content'] = 'Please check your email. You will receive an email with a secure link that will allow you to reset your password. If you don’t receive the email within five minutes, please check your spam folder.';
        }else{
            $data['status'] = 0;
            $data['content'] = 'There is no account registered to this email address';
        }
        $data['title'] = 'Forgot Password';
        return $data;
    }
    public function RetailerCheckForgotPassword(Request $request){
        $input = $request->all();
        $result = User::where('email',$request->input('email'))->where('type_id', 'R')->first();
        $input['token'] = str_random(40);
        User::where('email',$request->input('email'))->update(['reset_password'=>$input['token']]);
        if($result){
            \Mail::send('email.retailer_forgot_password', ['input' => $input], function ($m) use ($result) {
                $m->from('support@wattprice.com', 'Watt Price Solution');
                $m->to($result->email, $result->firstname)->subject('WattPrice Forgot Password');
            });
            $data['status'] = 1;
            $data['content'] = 'Please check your email. You will receive an email with a secure link that will allow you to reset your password. If you don’t receive the email within five minutes, please check your spam folder.';
        }else{
            $data['status'] = 0;
            $data['content'] = 'There is no account registered to this email address';
        }
        $data['title'] = 'Forgot Password';
        return $data;
    }

    public function ChangeResetPassword(Request $request){
        $token = $request->input('token');
        $email = $request->input('email');
        $password = $request->input('password');

        $result = User::where(
            [
                'email'=>$email,
                'reset_password'=>$token,
            ]
        )->first();

        if($result){
            User::where(
                [
                    'email'=>$email,
                    'reset_password'=>$token,
                ]
            )->update([
                'reset_password'=>'',
                'password'=>\Hash::make($password),
            ]);
            \Mail::send('email.reset_password_retailer', ['input' => $input], function ($m) use ($result) {
                $m->from('support@wattprice.com', 'Watt Price Solution');
                $m->to($result->email, $result->firstname)->subject('WattPrice Forgot Password');
            });
            $data['status'] = 1;
            $data['content'] = 'Password have changed';
        }else{
            $data['status'] = 0;
            $data['content'] = 'Token Missmath.';
        }
        $data['title'] = 'Reset Password';
        return $data;
    }
    public function RetailerChangeResetPassword(Request $request){
        $token = $request->input('token');
        $email = $request->input('email');
        $password = $request->input('password');

        $result = User::where(
            [
                'email'=>$email,
                'reset_password'=>$token,
            ]
        )->first();

        if($result){
            User::where(
                [
                    'email'=>$email,
                    'reset_password'=>$token,
                ]
            )->update([
                'reset_password'=>'',
                'password'=>\Hash::make($password),
            ]);
            \Mail::send('email.reset_password_retailer', ['input' => $input], function ($m) use ($result) {
                $m->from('support@wattprice.com', 'Watt Price Solution');
                $m->to($result->email, $result->firstname)->subject('WattPrice Forgot Password');
            });
            $data['status'] = 1;
            $data['content'] = 'Password have changed';
        }else{
            $data['status'] = 0;
            $data['content'] = 'Token Missmath.';
        }
        $data['title'] = 'Reset Password';
        return $data;
    }
}
