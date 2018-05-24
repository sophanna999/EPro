<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AuthorityCreditController extends Controller
{
    public function index()
    {
        $data['menu_all'] 	= \App\Models\AdminMenu::where('main_menu_id',0)->get();
        $data['main_menu'] 	= 'AuthorityCredit';
        $data['sub_menu'] 	= '';
        $data['title_page'] = 'Authority Credit Form';
        $data['menus'] 		= \App\Models\AdminMenu::ActiveMenu()->get();
        $data['permission'] = \AdminPermission::CheckPermission($data['main_menu']);
        return view('Admin.authority_credit',$data);
    }

    public function Approved($id) {
        
        $buy_credit = \App\Models\BuyCredit::find($id);
        $user_id    = $buy_credit->user_id;
        $user       = \App\User::where('id',$user_id)->first();
        $now_credit = $user->credit;
        $new_credit = $now_credit+$buy_credit->credit;

        \DB::beginTransaction();
        try {
            $data_update 		= [
                'status'		=>'A',
                'updated_at'	=>date('Y-m-d H:i:s'),
            ];
            \App\Models\BuyCredit::where('id',$id)->update($data_update);
            \App\Models\User::where('id',$user_id)->update(['credit'=>$new_credit]);
            \DB::commit();
            $return['status'] 	= 1;
            $return['content'] 	= 'Success';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status'] 	= 0;
            $return['content'] 	= 'Unsuccess'.$e->getMessage();
        }
        $return['title'] 		= 'Update Status';
        return json_encode($return);
    }

    public function Cancel($id) {
        \DB::beginTransaction();
        try {
            $data_update 		= [
                'status'		=>'C',
                'updated_at'	=>date('Y-m-d H:i:s'),
            ];
            \App\Models\BuyCredit::where('id',$id)->update($data_update);
            \DB::commit();
            $return['status'] 	= 1;
            $return['content'] 	= 'Success';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status'] 	= 0;
            $return['content'] 	= 'Unsuccess'.$e->getMessage();
        }
        $return['title'] 		= 'Update Status';
        return json_encode($return);
    }


    public function ListAuthorityCredit(){
    	$result = \App\Models\BuyCredit::leftjoin('users','buy_credits.user_id','=','users.id')
    	->leftjoin('credits','buy_credits.credit_id','=','credits.credit_id')
        ->where('buy_credits.status','WA')
    	->select('buy_credits.*','users.firstname', 'users.lastname','credits.name')->orderBy('buy_credits.created_at','DESC');
        return \Datatables::of($result)
        ->addIndexColumn()
        ->editColumn('user_id', function($rec){
            $str = $rec->firstname. ' '.$rec->lastname;
            return $str;
        })
        ->editColumn('file_name', function($rec){
            $str ='<img src="'.asset('uploads/bills/'.$rec->file_name).'" alt="image" height="60px" width="60px">';
            return $str;
        })
        ->editColumn('credit_id', function($rec){
            $str = $rec->name;
            return $str;
        })
        ->editColumn('status', function($rec){
            if ($rec->status == "WA") {
            	return "Waiting";
            } elseif ($rec->status == "A") {
            	return "Approved";
            } else {
            	return "Cancel";
            }
        })
        ->addColumn('action',function($rec){
            $str='
                <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-danger btn-condensed btn-cancel btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="Cancel">
                    <i class="ace-icon fa fa-times bigger-120"></i>
                </button>
                <button  class="btn btn-xs btn-info btn-condensed btn-changeStatus btn-tooltip" data-id="'.$rec->id.'" data-rel="tooltip" title="Approved">
                    <i class="ace-icon fa fa-check bigger-120"></i>
                </button>
            '.$button;
            return $str;
        })->make(true);
    }
}
