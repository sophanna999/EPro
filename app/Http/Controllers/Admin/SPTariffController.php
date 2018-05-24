<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;

class SPTariffController extends Controller
{
    public function index()
    {
        $data['menu_all']   = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        $data['main_menu']  = 'SP_Tariff';
        $data['sub_menu']   = 'SP_Tariff';
        $data['title_page'] = 'SP Tariff Form';
        $data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
        $data['permission'] = \AdminPermission::CheckPermission($data['main_menu']);
        return view('Admin.sp_tariff',$data);
    }

    public function edit($id)
    {
        return \App\Models\SpTariff::find($id);
    }

    public function update(Request $request, $id)
    {
        $edit_name   = $request->input('edit_name');
        $edit_value  = $request->input('edit_value');

        $validator = Validator::make($request->all(), [
            'edit_name'    => 'required',
            'edit_value'   => 'required'
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_update = [
					'key'   =>  $edit_name,
					'value' =>  $edit_value,
                ];
                \App\Models\SpTariff::where('id',$id)->update($data_update);
                \DB::commit();
                $return['status']   = 1;
                $return['content']  = 'Successful';
                $return['menus']    = \App\Models\AdminMenu::where('main_menu_id',0)->get();
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status']   = 0;
                $return['content']  = 'Unsuccessful'.$e->getMessage();;
            }
        }else{
            $return['status']   = 0;
        }
        $return['title']        = 'Edit Data';
        return json_encode($return);
    }

    public function ListSPTariff()
    {
        $result = \App\Models\SpTariff::select();
        return \Datatables::of($result)
        ->addColumn('action',function($rec){
            $permission = \AdminPermission::CheckPermission('SP_Tariff');
            if ($permission['U'] == "T") {
                $update = '<button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="Edit">
                    <i class="ace-icon fa fa-edit bigger-120"></i>
                </button>';
            }else {
                $update = "";
            }
            $view = '<button  class="btn btn-xs btn-info btn-condensed btn-detail btn-tooltip" data-id="'.$rec->id.'" data-rel="tooltip" title="Detail">
                <i class="ace-icon fa fa-eye bigger-120"></i>
            </button>';
            
            $str=$update.' '.$view;
            return $str;
        })->make(true);
    }
}
