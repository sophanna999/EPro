<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{
    public function index() {

    	$data['menu_all']   = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        $data['main_menu']  = 'RequestSetting';
        $data['sub_menu']   = 'ApproveRequest';
        $data['title_page'] = 'Approve Request Form';
        $data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
        $data['permission'] = \AdminPermission::CheckPermission($data['main_menu']);
        return view('Admin.approve_request',$data);
    }

    public function ListApproveRequest () {

    	$result = \App\Models\Requests::leftjoin('users', 'post_request.customer_id', '=', 'users.id')->where('post_request.status', 'O')->select('users.firstname', 'users.lastname', 'post_request.*')->orderBy('post_request.created_at','DESC');
        return \Datatables::of($result)
        ->addIndexColumn()
        ->editColumn('customer_id', function($rec){
            $str = $rec->firstname.' '.$rec->lastname;
            return $str;
        })
        ->editColumn('type_id', function($rec){
            if ($rec->type_id == 1) {
            	return "Business";
            }else {
            	return "Residentail";
            }
        })
        ->editColumn('status', function($rec){
            if ($rec->status == "O") {
            	return "Approve";
            }else {
            	return "";
            }
        })
        ->addColumn('action',function($rec){
            $str='<button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-primary btn-condensed btn-detail btn-tooltip" data-rel="tooltip" data-id="'.$rec->request_id.'" title="Detail">
                    <i class="ace-icon fa fa-eye bigger-120"></i>
                </button>';
            return $str;
        })
        ->make(true);
    }

    public function GetRequest($id){
        $data['requests'] = \App\Models\Requests::with('Existing','RequestEstimate.EstimateCommencement','RequestPhoto')->where('post_request.request_id',$id)->first();
        return $data['requests'];
    }
    
}
