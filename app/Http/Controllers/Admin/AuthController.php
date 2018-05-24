<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(){
    	return view('Admin.login');
    }

    public function CheckLogin(Request $request){

    	$username = $request->input('username');
    	$password = $request->input('password');
    	$remember = $request->input('remember',false);
    	if (\Auth::guard('admin')->attempt(['username' => $username, 'password' => $password],$remember)) {
            return 1;
        }else{
        	return 0;
        }


    }

    public function change_password(Request $request){
        $id             = $request->input('id');
        $password       = $request->input('password');
        $new_password   = \Hash::make($password);

        $validator      = Validator::make($request->all(), [
            'password'  => 'required'
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_update    = [
                    'password'  =>$new_password
                ];
                \App\Models\AdminUser::where('id',$id)->update($data_update);
                \DB::commit();
                $return['status']   = 1;
                $return['content']  = 'Success';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status']   = 0;
                $return['content']  = 'Unsuccess'.$e->getMessage();
            }
        }else{
            $return['status']   = 0;
        }
        $return['title']        = 'Change Password';
        return json_encode($return);
    }

    public function logout(){
        \Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
