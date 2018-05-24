<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Validator;
use Hash;

class CustomerController extends Controller
{
    public function index(){
        $data['title_page']   = 'Change Password';
        $data['main_menu']    = 'customer';
        $data['submenu_menu'] = '';
        $data['user']         = \Auth::guard('customer')->user();
    	return view('customer.dashboard',$data);
    }

    public function CheckSaveProfile(Request $request){
        $firstname = $request->input('firstname');
        $lastname  = $request->input('lastname');
        $mobile    = $request->input('mobile');
        $photo     = $request->input('photo',null);
        if($photo){
            $photo = $photo[0];
        }
        $validator  = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname'  => 'required',
            'mobile'    => 'required'
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {

                $data_insert = [
                    'firstname' =>  $firstname,
                    'lastname'  =>  $lastname,
                    'mobile'    =>  $mobile,
                    'photo'     =>  $photo,
                ];
                \App\User::where('id',\Auth::guard('customer')->user()->id)->update($data_insert);
                \DB::commit();
                $return['status']  = 1;
                $return['content'] = 'Successful';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status']  = 0;
                $return['content'] = 'Unsuccessful'.$e->getMessage();
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'Profile Updated?';
        return json_encode($return);
    }

    public function ChangePassword(){
        $data['title_page']   = 'Dashboard';
        $data['main_menu']    = 'customer';
        $data['submenu_menu'] = '';
        $data['user']         = \Auth::guard('customer')->user();
        return view('customer.change_password',$data);
    }

    public function change_password(Request $request){

        $current_password   = $request->input('current_password');
        $new_password       = \Hash::make($request->input('new_password'));

        $validator = Validator::make($request->all(), [
            'new_password' => 'required'
        ]);
        if (!$validator->fails()) {
            $customer = \Auth::guard('customer')->user();
            $password = $customer->password;
            \DB::beginTransaction();
            try {
                $data_update = [
                    'password'=>$new_password
                ];
                if (Hash::check($current_password, $password)) {

                    \App\Models\User::where('id',$customer->id)->update($data_update);
                    \DB::commit();
                    $return['status']   = 1;
                    $return['content']  = 'Success';
                } else {

                    $return['status']   = 0;
                    $return['content']  = 'Your current password not match';
                }
                
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status']   = 0;
                $return['content']  = 'Unsuccess'.$e->getMessage();
            }
        }else{
            $return['status']   = 0;
        }
        $return['title'] = 'Change Password';
        return json_encode($return);
    }
}
