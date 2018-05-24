<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class ChoosePlanController extends Controller
{
    public function ChoosePlan(Request $request){

        $post_offer_id   = $request->input('offer_id');
        
        $validator  = Validator::make($request->all(), [
            'offer_id'   => 'required',
        ]);
        if (!$validator->fails()) {

        	$customer 		= \Auth::guard('customer')->user();
            $customer_id 	= $customer->id;
            \DB::beginTransaction();
            try {

                $data_insert = [
                    'customer_id'     =>  $customer_id,
                    'post_offer_id'   =>  $post_offer_id,
                    'created_at'      =>  date('Y-m-d H:i:s'),
                ];
                \App\Models\ChoosePlan::insert($data_insert);
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
        $return['title'] = 'Choose Plan Form';
        return json_encode($return);
    }
}
