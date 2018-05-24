<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RetailerConditionController extends Controller
{
    public function index()
    {
		$data['menu_all']   = \App\Models\AdminMenu::where('main_menu_id',0)->get();
		$data['main_menu']  = 'Condition';
		$data['sub_menu']   = 'RetailerCondition';
		$data['title_page'] = 'Retailer Condition Form';
		$data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
		$data['permission'] = \AdminPermission::CheckPermission($data['main_menu']);
        return view('Admin.retailer_condition',$data);
    }
    public function store(Request $request)
    {
		$condition_name   = $request->input('name');
	    $this->validate($request, [
	        'file_name' => 'file',
	        'name' => 'required',
	    ]);
	    if ($request->hasFile('file_name')) {
	        $image           = $request->file('file_name');
	        $name            = time().'.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('uploads/conditions/');
	        $image->move($destinationPath, $name);
	        $data_insert = [
						'name'       =>  $condition_name,
						'file'       =>  $name,
						'type'       =>  'R',
						'created_at' =>  date('Y-m-d H:i:s')
	                ];

	             $result = \App\Models\Condition::insert($data_insert);
	                if ($result) {
	                    $return['status']   = 1;
	                    $return['content']  = 'Successful';
	                }else {
	                    $return['status']   = 0;
	                    $return['content']  = 'Unsuccessful';
	                }

	        $return['title']  = 'Submit Customer Condition';
	        return json_encode($return);
           
    	}
    }
    public function edit($id)
    {
        return \App\Models\Condition::find($id);
    }
    public function update(Request $request, $id)
    {
        $condition_name   = $request->input('edit_name');
        $this->validate($request, [
            'edit_file' => 'file',
            'edit_name' => 'required',
        ]);
        if ($request->hasFile('edit_file')) {
            $image           = $request->file('edit_file');
            $name            = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/conditions/');
            $image->move($destinationPath, $name);
            $data_insert = [
                        'name'       =>  $condition_name,
                        'file'       =>  $name,
                        'type'       =>  'R',
                        'updated_at' =>  date('Y-m-d H:i:s')
                    ];

                 $result = \App\Models\Condition::where('id', $id)->update($data_insert);
                    if ($result) {
                        $return['status']   = 1;
                        $return['content']  = 'Successful';
                    }else {
                        $return['status']   = 0;
                        $return['content']  = 'Unsuccessful';
                    }

            $return['title']  = 'Submit Retailer Condition';
            return json_encode($return);
           
        }
    }
    public function destroy($id)
    {
        \DB::beginTransaction();
        try {
            \App\Models\Condition::where('id',$id)->delete();
            \DB::commit();
            $return['status']   = 1;
            $return['content']  = 'Successful';
            $return['menus']    = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status']   = 0;
            $return['content']  = 'Unsuccessful'.$e->getMessage();;
        }
        $return['title']        = 'Delete Data';
        return json_encode($return);
    }

    public function ListRetailerCondition()
    {
        $result = \App\Models\Condition::where('type', 'R')->select();
        return \Datatables::of($result)
        ->addIndexColumn()
        ->addColumn('action',function($rec){
            $permission = \AdminPermission::CheckPermission('RetailerCondition');
            if ($permission['U'] == "T") {
                $update = '<button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="Edit">
                    <i class="ace-icon fa fa-edit bigger-120"></i>
                </button>';
            }else {
                $update = "";
            }
            // $delete = '<button  class="btn btn-xs btn-danger btn-condensed btn-delete btn-tooltip" data-id="'.$rec->id.'" data-rel="tooltip" title="Delete">
            //         <i class="ace-icon fa fa-trash bigger-120"></i>
            //     </button>';
            
            return $str=$update;
            
        })->make(true);
    }
}
