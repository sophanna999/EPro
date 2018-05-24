<?php

namespace App\Http\Controllers\Retailer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
	 public function index()
		{
			$data['title_page']   = 'Message Form';
			$data['main_menu']    = 'retailer';
			$data['submenu_menu'] = '';
			$user                 = \Auth::guard('retailer')->user();
			$messages             = \App\Models\Message::with('User','Admin')->where('member_id',$user->id)->orderBy('created_at','desc')->take('10')->get();
			$datas                = [];
		    foreach ($messages as $key => $message) {
		    	$datas[] = $message;
		    }
		    sort($datas);
		    $data['messages'] 	= $datas;
		    $data['user'] 		= $user;
			return view('retailer.chat',$data);	
		}
		 public function Send(Request $request){
	    	$detail  = $request->input('message');
	    	$user = \Auth::guard('retailer')->user();
	    	\DB::beginTransaction();
	        try {
	            $data_insert = [
					'member_id'         =>$user->id,
					'detail'            =>$detail,
					'read'              =>'F',
					'type_member_reply' =>'U',
					'created_at'        =>date('Y-m-d H:i:s'),
		    	];
		    	\App\Models\Message::insert($data_insert);
	            \DB::commit();
				$return['status']  = 1;
				$return['content'] = 'Successful';
	        } catch (Exception $e) {
	            \DB::rollBack();
				$return['status']  = 0;
				$return['content'] = 'Unsuccessful'.$e->getMessage();
	        }
	    	return json_encode($return);
    }
}
