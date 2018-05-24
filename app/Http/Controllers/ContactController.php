<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;

class ContactController extends Controller
{
    public function index(){
        $data['title_page']   = 'Contact';
        $data['main_menu']    = 'contact';
        $data['contact']      = \App\Models\ContactDetail::orderBy('id', 'DESC')->first();
        $data['submenu_menu'] = '';
    	return view('contact',$data);
    }
    public function create_contact (Request $request){
    	
    	$name          	= $request->input('name');
        $email          = $request->input('email');
        $phone          = $request->input('phone');
        $detail        	= $request->input('detail');

        $validator  = Validator::make($request->all(), [
            'name'         => 'required',
            'email'        => 'required',
            'phone'        => 'required',
            'detail'       => 'required'
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {

                $data_insert = [
                    'name'   =>  $name,
                    'email'  =>  $email,
                    'phone'  =>  $phone,
                    'detail' =>  $detail,
                ];
                \App\Contacts::insert($data_insert);
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
        $return['title'] = 'Send message ready';
        return json_encode($return);
    }
}
