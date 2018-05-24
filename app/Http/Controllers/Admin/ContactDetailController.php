<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class ContactDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu_all']   = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        $data['main_menu']  = 'ContactDetail';
        $data['sub_menu']   = 'ContactDetail';
        $data['title_page'] = 'Contact Detail Form';
        $data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
        $data['permission'] = \AdminPermission::CheckPermission($data['main_menu']);
        return view('Admin.contact_detail',$data);
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
        $email          = $request->input('email');
        $phone          = $request->input('phone');
        $fax            = $request->input('fax');
        $address        = $request->input('address');
        $photo          = $request->input('photo')[0];

        $validator  = Validator::make($request->all(), [
            'email'         => 'required',
            'phone'         => 'required',
            'fax'           => 'required',
            'address'       => 'required'
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {

                $data_insert = [
                    'email'     =>  $email,
                    'phone'     =>  $phone,
                    'fax'       =>  $fax,
                    'address'   =>  $address,
                    'image'     =>  $photo,
                ];
                \App\Models\ContactDetail::insert($data_insert);
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
        return \App\Models\ContactDetail::find($id);
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
        $email          = $request->input('edit_email');
        $phone          = $request->input('edit_phone');
        $fax            = $request->input('edit_fax');
        $address        = $request->input('edit_address');
        $photo          = $request->input('edit_photo')[0];

        $validator  = Validator::make($request->all(), [
            'edit_email'         => 'required',
            'edit_phone'         => 'required',
            'edit_fax'           => 'required',
            'edit_address'       => 'required'
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {

                $data_insert = [
                    'email'     =>  $email,
                    'phone'     =>  $phone,
                    'fax'       =>  $fax,
                    'address'   =>  $address,
                    'image'     =>  $photo,
                ];
                \App\Models\ContactDetail::where('id',$id)->update($data_insert);
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
            \App\Models\ContactDetail::where('id',$id)->delete();
            \DB::commit();
            $return['status']   = 1;
            $return['content']  = 'Successful';
            $return['menus']    = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status']   = 0;
            $return['content']  = 'Unsuccessful'.$e->getMessage();
        }
        $return['title'] = 'Delete Data';
        return json_encode($return);
    }

    public function ListContactDetail()
    {
        $result = \App\Models\ContactDetail::select()->orderBy('created_at','DESC');
        return \Datatables::of($result)
        ->addIndexColumn()
        ->editColumn('image', function($rec){
            $str ='<img src="'.asset('uploads/'.$rec->image).'" alt="image" height="60px" width="60px">';
            return $str;
        })
        ->addColumn('action',function($rec){
            $permission = \AdminPermission::CheckPermission('ContactDetail');
            if ($permission['U'] == "T") {
                $update = '<button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="Edit">
                    <i class="ace-icon fa fa-edit bigger-120"></i>
                </button>';
            }else {
                $update = "";
            }
            if ($permission['D'] == "T") {
                $delete = '<button  class="btn btn-xs btn-danger btn-condensed btn-delete btn-tooltip" data-id="'.$rec->id.'" data-rel="tooltip" title="Delete">
                    <i class="ace-icon fa fa-trash bigger-120"></i>
                </button>';
            }else {
                $delete = "";
            }
            $str=$update.' '.$delete;
            return $str;
        })->make(true);
    }
}
