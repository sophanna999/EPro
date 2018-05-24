<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu_all']   = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        $data['main_menu']  = 'FaqMenu';
        $data['sub_menu']   = '';
        $data['title_page'] = 'FAQ Form';
        $data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
        return view('Admin.banner',$data);
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
        $name       = $request->input('name');
        $link       = $request->input('link');
        $photo      = $request->input('photo')[0];

        $validator  = Validator::make($request->all(), [
            'name'   => 'required',
            'link'   => 'required'
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'name'      =>  $name,
                    'link'      =>  $link,
                    'image'     =>   $photo,
                ];
                \App\Models\Banner::insert($data_insert);
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
      return \App\Models\Banner::find($id);
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
        $name       = $request->input('edit_name');
        $link       = $request->input('edit_link');
        $photo      = $request->input('edit_photo')[0];

        $validator  = Validator::make($request->all(), [
            'edit_name'   => 'required',
            'edit_link'   => 'required'
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'name'      =>  $name,
                    'link'      =>  $link,
                    'image'     =>   $photo,
                ];
                \App\Models\Banner::where('id', $id)->update($data_insert);
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
        $return['title']        = 'Update Data';
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
            \App\Models\Banner::where('id',$id)->delete();
            \DB::commit();
            $return['status']   = 1;
            $return['content']  = 'Successful';
            $return['menus']    = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status']   = 0;
            $return['content']  = 'Unsuccessful'.$e->getMessage();;
        }
        $return['title'] = 'Delete Data';
        return json_encode($return);
    }

    public function ListBanner()
    {
        $result = \App\Models\Banner::select();
        return \Datatables::of($result)
        ->addIndexColumn()
        ->editColumn('image', function($rec){
            $str ='<img src="'.asset('uploads/banners/'.$rec->image).'" alt="image" height="60px" width="60px">';
            return $str;
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
