<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PendingPromotionController extends Controller
{
    public function index()
    {
    	$data['menu_all']   = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        $data['main_menu']  = 'Promotion';
        $data['sub_menu']   = 'PendingPromotion';
        $data['title_page'] = 'Pending Promotion Form';
        $data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
        $data['permission'] = \AdminPermission::CheckPermission($data['main_menu']);
        return view('Admin.pending_promotion',$data);
    }
    public function ListPending()
    {
        $result = \App\Models\Promotion::leftjoin('users','promotions.retailer_id','=','users.id')->where('promotions.status', 'W')->select('users.*','promotions.*','promotions.id as ProID');
        return \Datatables::of($result)
        ->addIndexColumn()
        ->editColumn('retailer_id', function($rec){
            $str =$rec->firstname.' '.$rec->lastname;
            return $str;
        })
        ->editColumn('images', function($rec){
            $str = '<img src="'.asset('uploads/promotions/'.$rec->images).'" alt="image" height="60px" width="60px">';
            return $str;
        })
        ->editColumn('name', function($rec){
            $str = '<a href="'.asset('uploads/promotions/'.$rec->files).'" target="_blank">'.$rec->name.'</a>';
            return $str;
        })
        ->addColumn('action',function($rec){
            $str='
                <button  class="btn btn-xs btn-danger btn-condensed btn-cancel btn-tooltip" data-id="'.$rec->ProID.'" data-rel="tooltip" title="Reject">
                    <i class="ace-icon fa fa-times bigger-120"></i>
                </button>
                <button  class="btn btn-xs btn-info btn-condensed btn-changeStatus btn-tooltip" data-id="'.$rec->ProID.'" data-rel="tooltip" title="Approve">
                    <i class="ace-icon fa fa-check bigger-120"></i>
                </button>';
            return $str;
        })->make(true);
    }
    public function ChangeStatus($id) {
        \DB::beginTransaction();
        try {
            $data_update = [
				'status'       =>  'A',
				'approve_date' =>  date('Y-m-d H:i:s'),
            ];
            \App\Models\Promotion::where('id',$id)->update($data_update);
            \DB::commit();
            $return['status']   = 1;
            $return['content']  = 'Success';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status']   = 0;
            $return['content']  = 'Unsuccess'.$e->getMessage();
        }
        $return['title']        = 'Approve Status';
        return json_encode($return);
    }
    public function Cancel($id) {
        \DB::beginTransaction();
        try {
            $data_update = [
				'status'     =>  'C',
				'updated_at' =>  date('Y-m-d H:i:s'),
            ];
            \App\Models\Promotion::where('id',$id)->update($data_update);
            \DB::commit();
            $return['status']   = 1;
            $return['content']  = 'Success';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status']   = 0;
            $return['content']  = 'Unsuccess'.$e->getMessage();
        }
        $return['title']        = 'Approve Status';
        return json_encode($return);
    }
}
