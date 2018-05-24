<?php

namespace App\Http\Controllers\Retailer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class OfferController extends Controller
{
    public function index(Request $request){
        $page                  = $request->input('page', 1);
        $item_per_page         = 5;
    	$data['title_page']    = 'Offer';
    	$data['main_menu']     = 'retailer';
        $data['submenu_menu']  = '';
    	$data['id']            = (($page-1)*$item_per_page)+1;
        $user                  = \Auth::guard('retailer')->user();
    	$data['user']          =  $user;
        $data['offer_data']    = \App\Models\PostOffer::where('user_id', $user->id)->orderBy('created_at','desc')->paginate($item_per_page);
    	return view('retailer.offer',$data);
    }
    public function PostOffer(){
    	$data['title_page']    = 'Offer';
    	$data['main_menu']     = 'retailer';
    	$data['submenu_menu']  = '';
    	$data['user']          = \Auth::guard('retailer')->user();
    	return view('retailer.post_offer',$data);
    }
    public function edit($id){
    	$data['title_page']    = 'Offer';
    	$data['main_menu']     = 'retailer';
    	$data['submenu_menu']  = '';
        $data['offer_data']    = \App\Models\PostOffer::find($id);
    	$data['user']          = \Auth::guard('retailer')->user();
    	return view('retailer.edit_post_offer',$data);
    }
    public function createOffer(Request $request){

        $retailer_name   = $request->input('retailer_name');
        $title           = $request->input('title');
        $detail          = $request->input('detail');
        $promotion_start = $request->input('promotion_start');
        $promotion_end   = $request->input('promotion_end');
        $contact_person  = $request->input('contact_person');
        $contact_number  = $request->input('contact_number');
        $contact_email   = $request->input('contact_email');
        $photo           = $request->input('photo')[0];

        $validator  = Validator::make($request->all(), [
            'retailer_name'     => 'required',
            'title'             => 'required',
            'detail'            => 'required',
            'promotion_start'   => 'required',
            'promotion_end'     => 'required',
            'contact_person'    => 'required',
            'contact_number'    => 'required',
            'contact_email'     => 'required',
        ]);
        if (!$validator->fails()) {
            $user = \Auth::guard('retailer')->user();
            $user_id = $user->id;
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'user_id'           =>  $user_id,
                    'retailer_name'     =>  $retailer_name,
                    'title'             =>  $title,
                    'detail'            =>  $detail,
                    'promotion_start'   =>  date('Y-m-d', strtotime(str_replace('-', '/', $promotion_start))),
                    'promotion_end'     =>  date('Y-m-d', strtotime(str_replace('-', '/', $promotion_end))),
                    'contact_person'    =>  $contact_person,
                    'contact_number'    =>  $contact_number,
                    'contact_email'     =>  $contact_email,
                    'photo'             =>  $photo,
                    'created_at'        =>  date('Y-m-d H:i:s')
                ];
                \App\Models\PostOffer::insert($data_insert);
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
        $return['title'] = 'Insert Data';
        return json_encode($return);
    }
    public function update(Request $request, $id){

        $retailer_name      = $request->input('retailer_name');
        $title              = $request->input('title');
        $detail             = $request->input('detail');
        $promotion_start    = $request->input('promotion_start');
        $promotion_end      = $request->input('promotion_end');
        $contact_person     = $request->input('contact_person');
        $contact_number     = $request->input('contact_number');
        $contact_email      = $request->input('contact_email');
        $photo              = $request->input('photo')[0];

        $validator  = Validator::make($request->all(), [
            'retailer_name'     => 'required',
            'title'             => 'required',
            'detail'            => 'required',
            'promotion_start'   => 'required',
            'promotion_end'     => 'required',
            'contact_person'    => 'required',
            'contact_number'    => 'required',
            'contact_email'     => 'required',
        ]);
        if (!$validator->fails()) {
            $user = \Auth::guard('retailer')->user();
            $user_id = $user->id;
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'user_id'           =>  $user_id,
                    'retailer_name'     =>  $retailer_name,
                    'title'             =>  $title,
                    'detail'            =>  $detail,
                    'promotion_start'   =>  $promotion_start,
                    'promotion_end'     =>  $promotion_end,
                    'contact_person'    =>  $contact_person,
                    'contact_number'    =>  $contact_number,
                    'contact_email'     =>  $contact_email,
                    'photo'             =>  $photo,
                ];
                \App\Models\PostOffer::where('post_offer_id',$id)->update($data_insert);
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
        $return['title'] = 'Update Data';
        return json_encode($return);
    }
}
