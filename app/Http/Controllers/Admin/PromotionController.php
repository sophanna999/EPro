<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    public function index()
    {
    	$data['menu_all']   = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        $data['main_menu']  = 'Promotion';
        $data['sub_menu']   = 'ApprovPromotion';
        $data['title_page'] = 'Approve Promotion Form';
        $data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
        $data['permission'] = \AdminPermission::CheckPermission($data['main_menu']);
        return view('Admin.approve_promotion',$data);
    }

    public function ListPromotion()
    {
        $result = \App\Models\Promotion::leftjoin('users','promotions.retailer_id','=','users.id')->where('promotions.status', 'A')->select('users.firstname','users.lastname', 'promotions.*','promotions.id as ProID')->orderBy('promotions.created_at','DESC');
        return \Datatables::of($result)
        ->addIndexColumn()
        ->editColumn('retailer_id', function($rec){
            $str =$rec->firstname.' '.$rec->lastname;
            return $str;
        })
        ->addColumn('action',function($rec){
            $permission = \AdminPermission::CheckPermission('Retailers');
            if ($permission['D'] == "T") {
                $delete = '<button  class="btn btn-xs btn-danger btn-condensed btn-delete btn-tooltip" data-id="'.$rec->ProID.'" data-rel="tooltip" title="Delete">
                    <i class="ace-icon fa fa-trash big4ger-120"></i>
                </button>';
            }else {
                $delete = "";
            }
            if ($permission['U'] == "T") {
                $update= '<button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-update btn-tooltip" data-rel="tooltip" data-id="'.$rec->ProID.'" title="Detail">
                    <i class="ace-icon fa fa-edit bigger-120"></i>
                </button>'.' '.$update;
            }else {
                $update = "";
            }
            $str=$update.' '.$delete;
            return $str;
        })->make(true);
    }
    public function edit($id)
    {
        return \App\Models\Promotion::find($id);
    }
    public function update(Request $request, $id)
    {
        $edit_name   = $request->input('edit_name');
        $edit_title  = $request->input('edit_title');
        $edit_detail = $request->input('edit_detail');

        $get_promotion = \App\Models\Promotion::where('id', $id)->first(); 
        if (!empty($request->file('edit_image'))) {
            $promotion_image      = $request->file('edit_image');
            $promotion_image_name = time().rand().'.'.$promotion_image->getClientOriginalExtension();
            $destinationPath      = public_path('uploads/promotions/');
            $promotion_image->move($destinationPath, $promotion_image_name);
        }

        if (!empty($request->file('edit_file'))) {
            $promotion_file      = $request->file('edit_file');
            $promotion_file_name = time().rand().'.'.$promotion_file->getClientOriginalExtension();
            $destinationPath     = public_path('uploads/promotions/');
            $promotion_file->move($destinationPath, $promotion_file_name);
        }

        \DB::beginTransaction();
        try {
            $data = [
                'name'       =>  $edit_name,
                'title'      =>  $edit_title,
                'detail'     =>  $edit_detail,
                // 'images'     =>  $promotion_image_name,
                // 'files'      =>  $promotion_file_name,
                'updated_at' =>  date('Y-m-d H:i:s'),
            ];
            if ($promotion_image_name != '') {
                $data['images'] = $promotion_image_name;
            }
            if ($promotion_file_name != '') {
                $data['files'] = $promotion_file_name;
            }
            \App\Models\Promotion::where('id', $id)->update($data);
            
            \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Successful';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Unsuccessful'.$e->getMessage();
            }
        $return['title'] = 'Update data';
        return json_encode($return);
    }

    public function delete($id)
    {
        \DB::beginTransaction();
        try {
            \App\Models\Promotion::where('id',$id)->delete();
            \DB::commit();
            $return['status'] = 1;
            $return['content'] = 'Successful';
            $return['menus'] = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status'] = 0;
            $return['content'] = 'Unsuccessful'.$e->getMessage();;
        }
        $return['title'] = 'Delete Data';
        return json_encode($return);
    }
}
