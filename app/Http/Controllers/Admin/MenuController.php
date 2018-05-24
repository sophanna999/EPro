<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu_all']   = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        $data['main_menu']  = 'ManageMenu';
        $data['sub_menu']   = '';
        $data['title_page'] = 'Manage Menue Form';
        $data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
        return view('Admin.menu',$data);
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
        $main_menu_id   =   $request->input('main_menu_id');
        $name           =   $request->input('name');
        $link           =   $request->input('link');
        $icon           =   $request->input('icon');
        $sort_id        =   $request->input('sort_id');
        $show           =   $request->input('show','F');

        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'link'  => 'required'
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'main_menu_id'  =>  $main_menu_id,
                    'name'          =>  $name,
                    'link'          =>  $link,
                    'icon'          =>  $icon,
                    'sort_id'       =>  $sort_id,
                    'show'          =>  $show,
                ];
                \App\Models\AdminMenu::insert($data_insert);
                \DB::commit();
                $return['status']   = 1;
                $return['content']  = 'สำเร็จ';
                $return['menus']    = \App\Models\AdminMenu::where('main_menu_id',0)->get();
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status']   = 0;
                $return['content']  = 'ไม่สำรเ็จ'.$e->getMessage();;
            }
        }else{
            $return['status']   = 0;
        }
        $return['title']        = 'เพิ่มข้อมูล';
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
        return \App\Models\AdminMenu::find($id);
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
        $main_menu_id   =   $request->input('main_menu_id');
        $name           =   $request->input('name');
        $link           =   $request->input('link');
        $icon           =   $request->input('icon');
        $sort_id        =   $request->input('sort_id');
        $show           =   $request->input('show','F');

        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'link'  => 'required'
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'main_menu_id'  =>  $main_menu_id,
                    'name'          =>  $name,
                    'link'          =>  $link,
                    'icon'          =>  $icon,
                    'sort_id'       =>  $sort_id,
                    'show'          =>  $show,
                ];
                \App\Models\AdminMenu::where('id',$id)->update($data_insert);
                \DB::commit();
                $return['status']   = 1;
                $return['content']  = 'Success';
                $return['menus']    = \App\Models\AdminMenu::where('main_menu_id',0)->get();
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status']   = 0;
                $return['content'] = 'Unsuccess'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'Edit Data';
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
            \App\Models\AdminMenu::where('id',$id)->delete();
            \DB::commit();
            $return['status']   = 1;
            $return['content']  = 'Success';
            $return['menus']    = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status']   = 0;
            $return['content']  = 'Unsuccess'.$e->getMessage();;
        }
        $return['title']        = 'Delete';
        return json_encode($return);
    }

    public function ListMenu(){
        $result = \App\Models\AdminMenu::with('MainMenu')->select();
        return \Datatables::of($result)
        ->editColumn('main_menu_id',function($rec){

            if($rec->main_menu_id){
                return $rec->MainMenu->name;
            }
        })
        ->editColumn('show',function($rec){
            if($rec->show=="T"){
                return 'Show';
            }else{
                return 'Close/Not Show';
            }
        })
        ->addColumn('action',function($rec){
            $str='
                <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="Edit">
                    <i class="ace-icon fa fa-edit bigger-120"></i>
                </button>
                <button  class="btn btn-xs btn-danger btn-condensed btn-delete btn-tooltip" data-id="'.$rec->id.'" data-rel="tooltip" title="Delete">
                    <i class="ace-icon fa fa-trash bigger-120"></i>
                </button>
            ';
            return $str;
        })->make(true);
    }
}
