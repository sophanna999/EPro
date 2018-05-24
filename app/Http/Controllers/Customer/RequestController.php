<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Mail;

class RequestController extends Controller
{
    public function index(Request $request){
        $page                 = $request->input('page',1);
        $type_id              = $request->input('type_id',null);
        $keyword              = $request->input('keyword');
        $item_per_page        = 5;
    	$data['title_page']   = 'New Request';
    	$data['main_menu']    = 'customer';
        $data['submenu_menu'] = '';
        $data['id']           = (($page-1)*$item_per_page)+1;
        $user                 = \Auth::guard('customer')->user();
    	$data['user']         = $user;
        $data['type_id']      = $type_id;
        $data['keyword']      = $keyword;
        if ($keyword == null) {
            if ($type_id == null) {
                // $data['lists'] = \App\Models\Requests::where('customer_id',$user->id)
                $data['lists'] = \App\Models\Requests::MyRequest($user->id)
                ->orderBy('created_at', 'DESC')
                ->paginate($item_per_page);        
            }else {
                $data['lists'] = \App\Models\Requests::where('type_id', $type_id)
                ->where('customer_id',$user->id)
                ->orderBy('created_at', 'DESC')
                ->paginate($item_per_page);
            }
        }else {
            if ($type_id==null) {
                $data['lists']   = \App\Models\Requests::where('random_request_id','like', '%' .$keyword. '%')
                ->orwhere('premise_address','like', '%' .$keyword. '%')
                ->orderBy('created_at', 'DESC')->paginate($item_per_page);  
            }else {
                $data['lists']   = \App\Models\Requests::where('type_id', $type_id)
                ->where(function($q) use($keyword){
                    $q->orWhere('random_request_id','like', '%' .$keyword. '%');
                    $q->orWhere('premise_address','like', '%' .$keyword. '%');
                })
                ->orderBy('created_at', 'DESC')->paginate($item_per_page);
            }
        }
    	return view('customer.request',$data);
    }

    public function edit($id){

        $data['title_page']   = 'Edit Request Form';
        $data['main_menu']    = 'request';
        $data['submenu_menu'] = '';
        $data['request_data'] = \App\Models\Requests::find($id);
        // $estimate_selects     = \App\Models\Request_Estimate::where('request_id', $id)->get();
        // $estimate_id          = array();
        // foreach ($estimate_selects as $estimate_select) {
        //     $estimate_id[] = $estimate_select->estimate_id;
        // }
        // $data['estimate_data']= $estimate_id;
        $photo_selects        = \App\Models\Request_Photo::where('request_id', $id)->get();
        foreach ($photo_selects as $key => $value) {
            $data['photos'][] = $value->photo_name;
        }
        $data['existing']     = \App\Models\Existing::get();
        $data['dwelling']     = \App\Models\Dwellings::get();
        $data['user']         = \Auth::guard('customer')->user();
        $data['estimate']     = \App\Models\Estimate_Commencement::get();
        return view('customer.edit_request',$data);

    }


    public function NewRequest(){
        $data['title_page']   = 'Request';
        $data['main_menu']    = 'customer';
        $data['submenu_menu'] = '';
        $data['existing']     = \App\Models\Existing::get();
        $data['user']         = \Auth::guard('customer')->user();
        $data['dwelling']     = \App\Models\Dwellings::get();
        $data['estimate']     = \App\Models\Estimate_Commencement::get();
        return view('customer.new_request',$data);
    }

    public function CreateBusiness(Request $request){

    	$company_name          	= $request->input('b_company_name');
        $uen_no          		= $request->input('b_uen_no');
        $premise_address        = $request->input('b_premise_address');
        $bill_address        	= $request->input('b_bill_address');
        // $mssl_no        		= $request->input('b_mssl_no');
        $avg_consumtion        	= $request->input('b_avg_consumtion');
        if (!empty($avg_consumtion)) {
            $avg_consumtion     = $request->input('b_avg_consumtion');
        }else {
            $avg_consumtion     = 0;
        }
        $existing_retailer      = $request->input('b_existing_retailer');
        $estimate_business      = $request->input('estimate_business');

        // $photo                  = $request->input('BusinessPhoto', []);
        // if (isset($photo)) {
        //     $photo              = $request->input('BusinessPhoto', []);
        // }else {
        //     $photo              = '';
        // }
        $email =  $request->input('email');
        $data  = $request->all();

        $validator  = Validator::make($request->all(), [
            'b_company_name'        => 'required',
            'b_uen_no'        		=> 'required',
            'b_premise_address'     => 'required',
            'b_bill_address'       	=> 'required',
            'b_existing_retailer'   => 'required'
        ]);
        if (!$validator->fails()) {
            $user = \Auth::guard('customer')->user();

            \DB::beginTransaction();
            $random = 1;
            try {
                $num_doc = \App\Models\DocNumber::where('type', 'R')->where('date_count', date('Y-m-d'))->first();
                if($num_doc) {
                    $random = date('Ymd').sprintf('%04d',$num_doc->amount+1);
                    \App\Models\DocNumber::where('type', 'R')->where('date_count', date('Y-m-d'))->update(['amount' => $num_doc->amount+1, 'updated_at' => date('Y-m-d H:i:s')]);
                } else {
                    $random = date('Ymd').sprintf('%04d',$random);
                    \App\Models\DocNumber::insert(['type' => 'R','amount' => 1, 'date_count' => date('Y-m-d'), 'created_at' => date('Y-m-d H:i:s')]);
                }
                $data_insert = [
                    'type_id'     			=>  1,
                    'dwelling_type_id'     	=>  0,
                    'company_name'          =>  $company_name,
                    'random_request_id'     =>  $random,
                    'uen_no'   				=>  $uen_no,
                    'premise_address'   	=>  $premise_address,
                    'bill_address'   		=>  $bill_address,
                    'mssl_no'   			=>  0,
                    'avr_consumtion'   		=>  $avg_consumtion,
                    'ex_retailer'           =>  $existing_retailer,
                    'customer_id'           =>  $user->id,
                    'price'                 =>  0,
                    'status'                =>  "W",
                    'created_at'   		    =>  date('Y-m-d H:i:s'),
                ];
                $id = \App\Models\Requests::insertGetId($data_insert);
                 \Mail::send('email.new_request', $data, function($message) use ($user)
                    {
                        $message->from(env('MAIL_USERNAME') , 'Watt Price Solution');
                        $message->to($user->email, $user->firstname)->subject('New Request');
                    });
                $created_at = date('Y-m-d H:i:s');
                // \App\Models\Requests::where('request_id', $id)->update(['random_request_id' => date('Ymd').$id, 'updated_at' => date('Y-m-d H:i:s')]);
                foreach ($estimate_business as $key => $value) {
                    \App\Models\Request_Estimate::insert(['request_id'=>$id, 'estimate_id'=>$value,'created_at'=>$created_at]);    
                }

                // if ($request->hasFile('BusinessPhoto')) {
                //     if ($photo_bill = $request->file('BusinessPhoto')) {
                //         foreach ($photo_bill as $key => $bills) {
                //             $bill_name           = time().rand().$key.'.'.$bills->getClientOriginalExtension();
                //             $destinationPath     = public_path('uploads/requests/');
                //             $bills->move($destinationPath, $bill_name);
                //             \App\Models\Request_Photo::insert(['request_id'=>$id, 'photo_name'=>$bill_name, 'customer_id'=>$user->id,'created_at'=>$created_at]);
                //         }
                //     }
                // }
                if ($photo_bill = $request->file('BusinessPhoto1')) {
                    $bill_name           = time().rand().'.'.$photo_bill->getClientOriginalExtension();
                    $destinationPath     = public_path('uploads/requests/');
                    $photo_bill->move($destinationPath, $bill_name);
                    \App\Models\Request_Photo::insert(['request_id'=>$id, 'photo_name'=>$bill_name, 'customer_id'=>$user->id,'created_at'=>$created_at]);
                }
                if ($photo_bill = $request->file('BusinessPhoto2')) {
                    $bill_name           = time().rand().'.'.$photo_bill->getClientOriginalExtension();
                    $destinationPath     = public_path('uploads/requests/');
                    $photo_bill->move($destinationPath, $bill_name);
                    \App\Models\Request_Photo::insert(['request_id'=>$id, 'photo_name'=>$bill_name, 'customer_id'=>$user->id,'created_at'=>$created_at]);
                }
                // foreach ($photo as $key => $value) {
                //     \App\Models\Request_Photo::insert(['request_id'=>$id, 'photo_name'=>$value, 'customer_id'=>$user->id,'created_at'=>$created_at]);
                // }
                \DB::commit();
                $return['status']  = 1;
                $return['content'] = 'You will receive a confirmation email shortly.';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status']  = 0;
                $return['content'] = 'Unsuccessful'.$e->getMessage();
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'Thank you for your submission.';
        return json_encode($return);
    }
    public function CreateResidentail(Request $request){

        $dwelling_type_id     = $request->input('r_dwelling_type');
        $premise_address      = $request->input('r_premise_address');
        $bill_address         = $request->input('r_bill_address');
        // $mssl_no           = $request->input('r_mssl_no');
        $avg_consumtion       = $request->input('r_avg_consumtion');
        if (!empty($avg_consumtion)) {
            $avg_consumtion     = $request->input('r_avg_consumtion');
        }else {
            $avg_consumtion     = 0;
        }
        $existing_retailer    = $request->input('r_ex_retailer');
        $estimate_residentail = $request->input('estimate_residentail');
        // $photo                = $request->file('ResidentailPhoto');
        // $photo                = $request->input('ResidentailPhoto', []);
        // if (isset($photo)) {
        //     $photo              = $request->input('ResidentailPhoto', []);
        // }else {
        //     $photo              = '';
        // }
        $email =  $request->input('email');
        $data  = $request->all();

        $validator  = Validator::make($request->all(), [
            'r_dwelling_type'   => 'required',
            'r_premise_address' => 'required',
            'r_bill_address'    => 'required',
            'r_avg_consumtion'  => 'required',
            'r_ex_retailer'     => 'required'
        ]);
        if (!$validator->fails()) {
            $user = \Auth::guard('customer')->user();
            \DB::beginTransaction();
            try {
                $num_doc = \App\Models\DocNumber::where('type', 'R')->where('date_count', date('Y-m-d'))->first();
                if($num_doc) {
                    $random = date('Ymd').sprintf('%04d',$num_doc->amount+1);
                    \App\Models\DocNumber::where('type', 'R')->where('date_count', date('Y-m-d'))->update(['amount' => $num_doc->amount+1, 'updated_at' => date('Y-m-d H:i:s')]);
                } else {
                    $random = date('Ymd').sprintf('%04d',$random);
                    \App\Models\DocNumber::insert(['type' => 'R','amount' => 1, 'date_count' => date('Y-m-d'), 'created_at' => date('Y-m-d H:i:s')]);
                }
                $data_insert = [
                    'type_id'     			=>  2,
                    'dwelling_type_id'     	=>  $dwelling_type_id,
                    'random_request_id'     =>  $random,
                    'company_name'       	=>  '',
                    'uen_no'   				=>  0,
                    'premise_address'   	=>  $premise_address,
                    'bill_address'   		=>  $bill_address,
                    'mssl_no'   			=>  0,
                    'avr_consumtion'   		=>  $avg_consumtion,
                    'ex_retailer'           =>  $existing_retailer,
                    'customer_id'           =>  $user->id,
                    'price'                 =>  0,
                    'status'                =>  "W",
                    'created_at'   		    =>  date('Y-m-d H:i:s'),
                ];

                // $id = \App\Models\Requests::insertGetId($data_insert);
                // \App\Models\Requests::where('request_id', $id)->update(['random_request_id'=>date('Ymd'.$id)]);
                // $created_at = date('Y-m-d H:i:s');
                // foreach ($photo as $key => $value) {
                //     \App\Models\Request_Photo::insert(['request_id'=>$id, 'photo_name'=>$all_photos, 'customer_id'=>$user->id,'created_at'=>$created_at]);
                // }

                $id = \App\Models\Requests::insertGetId($data_insert);
                \Mail::send('email.new_request', $data, function($message) use ($user)
                    {
                        $message->from(env('MAIL_USERNAME') , 'Watt Price Solution');
                        $message->to($user->email, $user->firstname)->subject('New Request');
                    });
                $created_at = date('Y-m-d H:i:s');
                // \App\Models\Requests::where('request_id', $id)->update(['random_request_id' => date('Ymd').$id, 'updated_at' => date('Y-m-d H:i:s')]);
                foreach ($estimate_residentail as $key => $value) {
                    \App\Models\Request_Estimate::insert(['request_id'=>$id, 'estimate_id'=>$value,'created_at'=>$created_at]);    
                }
                // if ($request->hasFile('ResidentailPhoto')) {
                    if ($photo_bill = $request->file('ResidentailPhoto1')) {
                        // foreach ($photo_bill as $key =>$bills) {
                            $bill_name           = time().rand().'.'.$photo_bill->getClientOriginalExtension();
                            $destinationPath     = public_path('uploads/requests/');
                            $photo_bill->move($destinationPath, $bill_name);
                            \App\Models\Request_Photo::insert(['request_id'=>$id, 'photo_name'=>$bill_name, 'customer_id'=>$user->id,'created_at'=>$created_at]);
                        // }
                    }
                    if ($photo_bill = $request->file('ResidentailPhoto2')) {
                        // foreach ($photo_bill as $key =>$bills) {
                            $bill_name           = time().rand().'.'.$photo_bill->getClientOriginalExtension();
                            $destinationPath     = public_path('uploads/requests/');
                            $photo_bill->move($destinationPath, $bill_name);
                            \App\Models\Request_Photo::insert(['request_id'=>$id, 'photo_name'=>$bill_name, 'customer_id'=>$user->id,'created_at'=>$created_at]);
                        // }
                    }
                // }
                // foreach ($photo as $key => $value) {
                //     \App\Models\Request_Photo::insert(['request_id'=>$id, 'photo_name'=>$value, 'customer_id'=>$user->id,'created_at'=>$created_at]);
                // }
                \DB::commit();
                $return['status']  = 1;
                $return['content'] = 'You will receive a confirmation email shortly.';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status']  = 0;
                $return['content'] = 'Unsuccessful'.$e->getMessage();
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'Thank you for your submission.';
        return json_encode($return);
    }

    public function UpdateResidentail(Request $request, $id){

        $dwelling_type_id     = $request->input('r_dwelling_type');
        $premise_address      = $request->input('r_premise_address');
        $bill_address         = $request->input('r_bill_address');
        $avg_consumtion       = $request->input('r_avg_consumtion');
        $existing_retailer    = $request->input('r_ex_retailer');
        $estimate_residentail = $request->input('estimate_residentail');
        // $photo                = $request->input('ResidentailPhoto');

        $validator  = Validator::make($request->all(), [
            'r_dwelling_type'   => 'required',
            'r_premise_address' => 'required',
            'r_bill_address'    => 'required',
            'r_avg_consumtion'  => 'required',
            'r_ex_retailer'     => 'required'
        ]);
        if (!$validator->fails()) {
            $user = \Auth::guard('customer')->user();
            \DB::beginTransaction();
            try {
                $all_photos = "";
                foreach ($photo as $key => $value) {
                    $all_photos = $value;
                }
                $data_insert = [
                    'type_id'               =>  2,
                    'dwelling_type_id'      =>  $dwelling_type_id,
                    'company_name'          =>  '',
                    'uen_no'                =>  0,
                    'premise_address'       =>  $premise_address,
                    'bill_address'          =>  $bill_address,
                    'avr_consumtion'        =>  $avg_consumtion,
                    'ex_retailer'           =>  $existing_retailer,
                    'customer_id'           =>  $user->id,
                    'estimate_id'           =>  $estimate_residentail,
                    'price'                 =>  0,
                ];
                \App\Models\Requests::where('request_id', $id)->update($data_insert);
                $created_at = date('Y-m-d H:i:s');
                \App\Models\Request_Photo::where('request_id', $id)->delete();
                foreach ($photo as $key => $value) {
                    \App\Models\Request_Photo::insert(['request_id'=>$id,'photo_name'=>$all_photos,'customer_id'=>$user->id,'created_at'=>$created_at]);
                }
                // $created_at = date('Y-m-d H:i:s');
                // $updated_at = date('Y-m-d H:i:s');
                // \App\Models\Request_Estimate::where('request_id', $id)->delete();
                // foreach ($estimate_residentail as $key => $value) {
                //     \App\Models\Request_Estimate::insert(['request_id'=>$id, 'estimate_id'=>$value,'created_at'=>$created_at,'updated_at'=>$updated_at]);
                // }
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Successful';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Unsuccessful'.$e->getMessage();
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'Update data';
        return json_encode($return);
    }
    public function UpdateBusiness(Request $request, $id){

        $company_name           = $request->input('b_company_name');
        $uen_no                 = $request->input('b_uen_no');
        $premise_address        = $request->input('b_premise_address');
        $bill_address           = $request->input('b_bill_address');
        $mssl_no                = $request->input('b_mssl_no');
        $avg_consumtion         = $request->input('b_avg_consumtion');
        $existing_retailer      = $request->input('b_existing_retailer');
        $estimate_business      = $request->input('estimate_business');
        $photo                  = $request->input('BusinessPhoto');

        $validator  = Validator::make($request->all(), [
            'b_company_name'        => 'required',
            'b_uen_no'              => 'required',
            'b_premise_address'     => 'required',
            'b_bill_address'        => 'required',
            'b_mssl_no'             => 'required',
            'b_avg_consumtion'      => 'required',
            'b_existing_retailer'   => 'required'
        ]);
        if (!$validator->fails()) {
            $user = \Auth::guard('customer')->user();
            \DB::beginTransaction();
            try {
                $all_photos = "";
                foreach ($photo as $key => $value) {
                    $all_photos = $value;
                }
                $data_insert = [
                    'type_id'               =>  1,
                    'dwelling_type_id'      =>  0,
                    'company_name'          =>  $company_name,
                    'uen_no'                =>  $uen_no,
                    'premise_address'       =>  $premise_address,
                    'bill_address'          =>  $bill_address,
                    'mssl_no'               =>  $mssl_no,
                    'avr_consumtion'        =>  $avg_consumtion,
                    'ex_retailer'           =>  $existing_retailer,
                    'customer_id'           =>  $user->id,
                    'estimate_id'           =>  $estimate_business,
                    'price'                 =>  0,
                ];
               \App\Models\Requests::where('request_id', $id)->update($data_insert);
               $created_at = date('Y-m-d H:i:s');
               \App\Models\Request_Photo::where('request_id', $id)->delete();
               foreach ($photo as $key => $value) {
                    \App\Models\Request_Photo::insert(['request_id'=>$id,'photo_name'=>$all_photos,'customer_id'=>$user->id,'created_at'=>$created_at]);
                }
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
        $return['title'] = 'Update data';
        return json_encode($return);
    }


}
