<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu_all']   = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        $data['main_menu']  = 'Credit';
        $data['sub_menu']   = 'Credit';
        $data['title_page'] = 'Credit Form';
        $data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
        $data['permission'] = \AdminPermission::CheckPermission($data['main_menu']);
        return view('Admin.credit',$data);
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
        $credit     = $request->input('credit');
        $price      = $request->input('price');

        $validator  = Validator::make($request->all(), [
            'name'    => 'required',
            'credit'  => 'required',
            'price'   => 'required'
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'name'      =>  $name,
                    'credit'    =>  $credit,
                    'price'     =>  $price,
                ];
                \App\Models\Credit::insert($data_insert);
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
         return \App\Models\Credit::find($id);
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
        $credit     = $request->input('edit_credit');
        $price      = $request->input('edit_price');

        $validator  = Validator::make($request->all(), [
            'edit_name'    => 'required',
            'edit_credit'  => 'required',
            'edit_price'   => 'required'
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'name'      =>  $name,
                    'credit'    =>  $credit,
                    'price'     =>  $price,
                ];
                \App\Models\Credit::where('credit_id', $id)->update($data_insert);
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
            \App\Models\Credit::where('credit_id',$id)->delete();
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

    public function ListCredit()
    {
        $result = \App\Models\Credit::select();
        return \Datatables::of($result)
        ->addIndexColumn()
        // ->editColumn('image', function($rec){
        //     $str ='<img src="'.asset('uploads/'.$rec->image).'" alt="image" height="60px" width="60px">';
        //     return $str;
        // })
        ->addColumn('action',function($rec){
            $permission = \AdminPermission::CheckPermission('ContactDetail');
            if ($permission['U'] == "T") {
                $update = '<button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->credit_id.'" title="Edit">
                    <i class="ace-icon fa fa-edit bigger-120"></i>
                </button>';
            return $update;
            }
        })->make(true);
    }
}
