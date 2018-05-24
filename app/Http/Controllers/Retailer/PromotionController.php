<?php

namespace App\Http\Controllers\Retailer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Mail;


class PromotionController extends Controller
{
    public function index(Request $request) {
		$page                   = $request->input('page', 1);
		$item_per_page          = 5;
		$data['title_page']     = 'Promotion';
		$data['main_menu']      = 'retailer';
		$data['submenu_menu']   = '';
		$data['id']             = (($page-1)*$item_per_page)+1;
		$user                   = \Auth::guard('retailer')->user();
		$data['user']           =  $user;
		$data['promotion_data'] = \App\Models\Promotion::where('retailer_id', $user->id)->orderBy('created_at','desc')->paginate($item_per_page);
    	return view('retailer.promotion',$data);
    }
    public function create(Request $request)
    {
    	$data['title_page']    = 'Promotion Form';
    	$data['main_menu']     = 'Promotion';
    	$data['submenu_menu']  = '';
    	$data['user']          = \Auth::guard('retailer')->user();
    	return view('retailer.create_promotion');
    }
    public function StorePromotion(Request $request)
    {
		$name   = $request->input('name');
		$title  = $request->input('title');
        $detail = $request->input('detail');
        
        if ($promotion_images = $request->file('promotion_images')) {
                $res_image           = time().rand().'.'.$promotion_images->getClientOriginalExtension();
                $destinationPath     = public_path('uploads/promotions/');
                $promotion_images->move($destinationPath, $res_image);
            }
        if ($promotion_files = $request->file('promotion_files')) {
                $res_files           = time().rand().'.'.$promotion_files->getClientOriginalExtension();
                $destinationPath     = public_path('uploads/promotions/');
                $promotion_files->move($destinationPath, $res_files);
            }
        $data = $request->all();

        $validator  = Validator::make($request->all(), [
			'name'  => 'required',
			'title' => 'required',
        ]);
        if (!$validator->fails()) {
            $user = \Auth::guard('retailer')->user();
            $retailer_id = $user->id;
            \DB::beginTransaction();
            $random = 1;
            try {
                $num_doc = \App\Models\DocNumber::where('type', 'P')->where('date_count', date('Y-m-d'))->first();
                if($num_doc) {
                    $random = date('Ymd').sprintf('%04d',$num_doc->amount+1);
                    \App\Models\DocNumber::where('type', 'P')->where('date_count', date('Y-m-d'))->update(['amount' => $num_doc->amount+1, 'updated_at' => date('Y-m-d H:i:s')]);
                } else {
                    $random = date('Ymd').sprintf('%04d',$random);
                    \App\Models\DocNumber::insert(['type' => 'P','amount' => 1, 'date_count' => date('Y-m-d'), 'created_at' => date('Y-m-d H:i:s')]);
                }
                $data_insert = [
                    'retailer_id' => $retailer_id,
                    'name'        => $name,
                    'title'       => $title,
                    'detail'      => $detail,
                    'images'      => $res_image,
                    'files'       => $res_files,
                    'status'      => 'W',
                    'random_id'   => $random,
                    'created_at'  => date('Y-m-d H:i:s')
                ];
                \App\Models\Promotion::insert($data_insert);
                \Mail::send('email.new_promotion', $data, function($message) use ($user)
                    {
                        $message->from(env('MAIL_USERNAME') , 'Watt Price Solution');
                        $message->to($user->email, $user->firstname)->subject('New Promotion');
                    });
                \DB::commit();
                $return['status']  = 1;
                $return['content'] = 'Please wait for admin approval';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status']  = 0;
                $return['content'] = 'Unsuccessful'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'Promotion Details Updated';
        return json_encode($return);
    }
    public function GetPromotion($id)
    {
        $data['title_page']     = 'Promotion Detail';
        $data['promotion_data'] = \App\Models\Promotion::find($id);
        $data['user']           = \Auth::guard('retailer')->user();
        return view('retailer.promotion_detail',$data);
    }
    public function UpdatePromotion(Request $request, $id)
    {
        $name   = $request->input('name');
        $title  = $request->input('title');
        $detail = $request->input('detail');

        $validator = Validator::make($request->all(), [
            'name'   => 'required',
            'title'  => 'required',
            'detail' => 'required',
        ]);
        if (!$validator->fails()) {
            $user = \Auth::guard('retailer')->user();
            $retailer_id = $user->id;
            \DB::beginTransaction();
            try {
                $data_insert = [

                    'retailer_id' => $retailer_id,
                    'name'        => $name,
                    'title'       => $title,
                    'detail'      => $detail
                ];
                \App\Models\Promotion::where('id',$id)->update($data_insert);
                \DB::commit();
                $return['status']  = 1;
                $return['content'] = 'Successful';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status']  = 0;
                $return['content'] = 'Unsuccessful'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'Edit Data';
        return json_encode($return);
    }
}
