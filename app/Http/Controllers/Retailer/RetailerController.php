<?php

namespace App\Http\Controllers\Retailer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Hash;

class RetailerController extends Controller
{
	public function index(){
    	$data['title_page']    = 'Dashboard';
    	$data['main_menu']     = 'customer';
    	$data['submenu_menu']  = '';
    	$data['user']          = \Auth::guard('retailer')->user();
    	return view('retailer.dashboard',$data);
    }

    public function Profile(){
    	$data['title_page']    = 'Dashboard';
    	$data['main_menu']     = 'retailer';
    	$data['submenu_menu']  = '';
    	$data['user']          = \Auth::guard('retailer')->user();
    	return view('retailer.profile',$data);
    }

     public function CheckSaveProfile(Request $request){
        
        $firstname  = $request->input('firstname');
        $lastname   = $request->input('lastname');
        // $company    = $request->input('company');
        $mobile     = $request->input('mobile');
        $photo      = $request->input('photo',null);
        if($photo){
            $photo  = $photo[0];
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
                \App\User::where('id',\Auth::guard('retailer')->user()->id)->update($data_insert);
                \DB::commit();
                $return['status']   = 1;
                $return['content']  = 'Successful';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status']   = 0;
                $return['content']  = 'Unsuccessful'.$e->getMessage();
            }
        }else{
            $return['status']       = 0;
        }
        $return['title']            = 'Profile Updated';
        $return['title_error']      = 'Can not update your profile';
        return json_encode($return);
    }

    public function ChangePassword(){
        $data['title_page']         = 'Change Password Form';
        $data['main_menu']          = 'reatiler';
        $data['submenu_menu']       = '';
        $data['user']               = \Auth::guard('retailer')->user();
        return view('retailer.change_password',$data);
    }
    public function change_password(Request $request){

        $current_password   =   $request->input('current_password');
        $new_password       =   \Hash::make($request->input('new_password'));

        $validator          =   Validator::make($request->all(), [
            'new_password'  => 'required'
        ]);
        if (!$validator->fails()) {
            $retailer   = \Auth::guard('retailer')->user();
            $id         = $retailer->id;
            $password   = $retailer->password;
            \DB::beginTransaction();
            try {
                $data_update    = [
                    'password'  =>  $new_password
                ];
                
                if (Hash::check($current_password, $password)) {
                    \App\Models\User::where('id', $id)->update($data_update);
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
        $return['title']        = 'Change Password';
        return json_encode($return);
    }
}
