<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    public function CustomerMessage(){
    	$data['menu_all']   = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        $data['main_menu']  = 'Message';
        $data['sub_menu']   = 'Message';
        $data['title_page'] = 'Message Form';
        $data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
        $data['permission'] = \AdminPermission::CheckPermission($data['main_menu']);
        return view('Admin.message',$data);
    }
    public function RetailerMessage(){
        $data['menu_all']   = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        $data['main_menu']  = 'Message';
        $data['sub_menu']   = 'Message';
        $data['title_page'] = 'Message Form';
        $data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
        return view('Admin.retailer_message',$data);
    }

    public function ListChat(){
    	$result = \App\Models\Message::join('users','users.id','=','messages.member_id')
    	->select(['messages.*','users.firstname','users.type_id'])->groupBy('messages.member_id');
        return \Datatables::of($result)
        ->addIndexColumn()
        ->addColumn('type_id',function($rec){
        	if($rec->type_id=="C"){
        		return 'Customer';
        	}else{
        		return 'Retailer';
        	}
        })

        ->addColumn('action',function($rec){
            $str='
                <a href="'.url('admin/Message/'.$rec->id).'" data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="Message">
                    <i class="ace-icon fa fa-search bigger-120"></i>
                </a>
            ';
            return $str;
        })->make(true);
    }
    public function CustomerListChat(){
        $result = \App\Models\Message::leftjoin('users','users.id','=','messages.member_id')
        ->select(['messages.*','users.firstname','users.id as uid','users.type_id'])->where('users.type_id', 'C')->groupBy('messages.member_id');
        return \Datatables::of($result)
        ->addIndexColumn()
        ->addColumn('type_id',function($rec){
            if($rec->type_id=="C"){
                return 'Customer';
            }
        })
        ->addColumn('action',function($rec){
            $str='
                <a href="'.url('admin/Message/'.$rec->uid).'" data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-success btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="Message">
                    <i class="ace-icon fa fa-commenting bigger-120"></i>
                </a>
            ';
            return $str;
        })->make(true);
    }

    public function RetailerListChat(){
        $result = \App\Models\Message::leftjoin('users','users.id','=','messages.member_id')
        ->select(['messages.*','users.firstname','users.id as uid','users.type_id'])->where('users.type_id', 'R')->groupBy('messages.member_id');
        return \Datatables::of($result)
        ->addIndexColumn()
        ->addColumn('type_id',function($rec){
            if($rec->type_id=="R"){
                return 'Retailer';
            }
        })
        ->addColumn('action',function($rec){
            $str='
                <a href="'.url('admin/Message/'.$rec->uid).'" data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-success btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="Message">
                    <i class="ace-icon fa fa-commenting bigger-120"></i>
                </a>
            ';
            return $str;
        })->make(true);
    }
    public function Message($id){
        $data['main_menu']  = 'message';
        $data['sub_menu']   = '';
        $data['title_page'] = 'Message';
        $data['user']       = \Auth::guard('admin')->user();
        $data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
        $messages = \App\Models\Message::with('User','Admin')->where('member_id',$id)->orderBy('created_at','desc')->take('10')->get();
        $datas = [];
        foreach ($messages as $key => $message) {
            $datas[] = $message;
        }
        sort($datas);
        $data['messages'] = $datas;
        return view('Admin.chat',$data);
    }

    public function Send(Request $request){
        $detail     = $request->input('message');
        $user_id    = $request->input('user_id');
        $user       = \Auth::guard('admin')->user();
        \DB::beginTransaction();
        try {
            $data_insert = [
                'member_id'         =>  $user_id,
                'detail'            =>  $detail,
                'read'              =>  'F',
                'type_member_reply' =>  'A',
                'admin_id'          =>  $user->id,
                'created_at'        =>  date('Y-m-d H:i:s'),
            ];
            \App\Models\Message::insert($data_insert);
            \DB::commit();
            $return['status']   = 1;
            $return['content']  = 'Successful';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status']   = 0;
            $return['content']  = 'Unsuccessful'.$e->getMessage();
        }
        return json_encode($return);
    }
}
