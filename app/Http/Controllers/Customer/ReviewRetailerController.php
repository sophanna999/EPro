<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class ReviewRetailerController extends Controller
{
    public function index(Request $request){

    	$data['title_page']    = 'Submit Review Retailer';
    	$data['main_menu']     = 'customer';
        $page                  = $request->input('page',1);
        $item_per_page         = 5;
        $data['id']            = (($page-1)*$item_per_page)+1;
        $user                  = \Auth::guard('customer')->user();
    	$data['submenu_menu']  = '';
    	$data['user']          = $user;
    	$data['retailer_name'] = \App\Models\User::where('type_id', 'R')->where('status','A')->get();
        $data['review'] = \App\Models\ReviewRetailer::where('customer_id', $user->id)->orderBy('created_at')->with('retailer')->paginate($item_per_page);
    	return view('customer.review_retailer',$data);
    }
    public function create(Request $request){

    	$retailer        	= $request->input('retailer');
        $pre_sale        	= $request->input('pre_sale');
        $after_sale         = $request->input('after_sale');
        $price             	= $request->input('price');
        $comment            = $request->input('comment');

        $validator  = Validator::make($request->all(), [
            'retailer'     	=> 'required',
            'pre_sale'     	=> 'required',
            'after_sale'   	=> 'required',
            'price'       	=> 'required'
        ]);
        if (!$validator->fails()) {
            $user = \Auth::guard('retailer')->user();
            $retailer_id = $user->id;
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'retailer_id'      =>  $retailer,
                    'customer_id'      =>  \Auth::guard('customer')->user()->id,
                    'point_pre_sale'   =>  $pre_sale,
                    'point_after_sale' =>  $after_sale,
                    'point_price'      =>  $price,
                    'comment'          =>  $comment,
                ];
                \App\Models\ReviewRetailer::insert($data_insert);
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
