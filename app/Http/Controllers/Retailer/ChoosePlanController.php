<?php

namespace App\Http\Controllers\Retailer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class ChoosePlanController extends Controller
{
    public function index(Request $request){
        $page                     = $request->input('page', 1);
        $item_per_page            = 5;
        $data['title_page']       = 'Choose Plan Form';
        $data['main_menu']        = 'ChoosePlan';
        $data['submenu_menu']     = '';
        $data['id']               = (($page-1)*$item_per_page)+1;
        $user                     = \Auth::guard('retailer')->user();
        $data['user']             = $user;
        $data['offer_data']       = $post_offer; 
        $data['choose_plan_data'] = \App\Models\ChoosePlan::leftjoin('users', 'choose_plan.customer_id', '=', 'users.id')
    	->leftjoin('post_offers', 'choose_plan.post_offer_id', '=', 'post_offers.post_offer_id')
    	->where('post_offers.user_id', $user->id)
    	->orderBy('choose_plan.created_at','desc')->paginate($item_per_page);
    	return view('retailer.choose_plan',$data);
    }
    public function detail($id){

        $data['title_page']         = 'Choose Plan Detail';
        $data['main_menu']          = 'ChoosePlan';
        $data['submenu_menu']       = '';
        $data['quotation_name']     = \App\Models\Quotation::get();
        $data['status']             = \App\Models\SubmitQuote::get();
        $data['user']               = \Auth::guard('retailer')->user();
        $data['choose_plan_detail'] = \App\Models\ChoosePlan::leftjoin('users', 'choose_plan.customer_id', '=', 'users.id')->leftjoin('post_offers', 'choose_plan.post_offer_id', '=', 'post_offers.post_offer_id')->find($id);
    	return view('retailer.choose_plan_detail',$data);
    }
    public function submitquote(Request $request) {

        $customer_id    = $request->input('customer_id');
        $choose_plan_id = $request->input('choose_plan_id');
        $request_id     = $request->input('request_id');
        $quote_id       = $request->input('quote_id');
        $status         = $request->input('status');
        $photo          = $request->input('photo')[0];

        $validator  = Validator::make($request->all(), [
            'quote_id'     => 'required',
            'status'       => 'required'
        ]);
        if (!$validator->fails()) {
            $retailer       = \Auth::guard('retailer')->user();
            $retailer_id    = $retailer->id;
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'customer_id'     =>  $customer_id,
                    'retailer_id'     =>  $retailer_id,
                    'choose_plan_id'  =>  $choose_plan_id,
                    'request_id'      =>  $request_id,
                    'quotes_id'       =>  $quote_id,
                    'bill_image'      =>  $photo,
                    'status'          =>  $status,
                    'created_at'      =>  date('Y-m-d H:i:s'),
                ];
                \App\Models\SubmitQuote::insert($data_insert);
                \DB::commit();
                $return['status']   = 1;
                $return['content']  = 'Successful';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status']   = 0;
                $return['content']  = 'Unsuccessful'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'Submitted Data';
        return json_encode($return);
    }
}
