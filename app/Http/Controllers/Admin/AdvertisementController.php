<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu_all']   = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        $data['main_menu']  = 'Advertisement';
        $data['sub_menu']   = 'Advertisement';
        $data['title_page'] = 'Advertisement Form';
        $data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
        $data['permission'] = \AdminPermission::CheckPermission($data['main_menu']);
        return view('Admin.advertisement',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title          = $request->input('title');
        $detail         = $request->input('detail');
        $photo          = $request->input('photo')[0];

        $validator      = Validator::make($request->all(), [
            'title'     => 'required',
            'detail'    => 'required'
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'adv_title'    =>  $title,
                    'adv_detail'   =>  $detail,
                    'adv_image'    =>  $photo ,
                ];
                \App\Models\Advertisement::insert($data_insert);
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
        $return['title']        = 'Insert Data';
        return json_encode($return);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return \App\Models\Advertisement::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $title      = $request->input('edit_title');
        $detail     = $request->input('edit_detail');
        $photo      = $request->input('edit_photo')[0];

        $validator = Validator::make($request->all(), [
            'edit_title'    => 'required',
            'edit_detail'   => 'required'
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'adv_title' =>$title,
                    'adv_detail'=>$detail,
                    'adv_image' =>$photo,
                ];
                \App\Models\Advertisement::where('id',$id)->update($data_insert);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::beginTransaction();
        try {
            \App\Models\Advertisement::where('id',$id)->delete();
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
     public function ListAdvertisement()
    {
        $result     = \App\Models\Advertisement::select();
        return \Datatables::of($result)
        ->addIndexColumn()
        ->editColumn('adv_image', function($rec){
            $str ='<img src="'.asset('uploads/advertisements/'.$rec->adv_image).'" alt="image" height="60px" width="60px">';
            return $str;
        })

        ->addColumn('action',function($rec){
            $permission = \AdminPermission::CheckPermission('Advertisement');
            if ($permission['U'] == "T") {
                $update = '<button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="Edit">
                    <i class="ace-icon fa fa-edit bigger-120"></i>
                </button>';
            }else {
                $update ="";
            }
            if ($permission['D'] == "T") {
                $delete = '<button  class="btn btn-xs btn-danger btn-condensed btn-delete btn-tooltip" data-id="'.$rec->id.'" data-rel="tooltip" title="Delete">
                    <i class="ace-icon fa fa-trash bigger-120"></i>
                </button>';
            }else {
                $delete ="";
            }
            
            $str=$update.' '.$delete;
            return $str;
        })->make(true);
    }
}
