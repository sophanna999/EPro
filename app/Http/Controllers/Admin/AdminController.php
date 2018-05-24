<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu_all']   = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        $data['main_menu']  = 'AdminUser';
        $data['sub_menu']   = 'AdminUser';
        $data['title_page'] = 'Admin User Form';
        $data['permission'] = \AdminPermission::CheckPermission($data['main_menu']);
        //dd(\Session::get('permission'));
        $data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
        $data['menus_data'] = \App\Models\AdminMenu::get();
        $admin              = \Auth::guard('admin')->user();
        $data['admin']      = \App\Models\AdminUser::find($admin->id);
        $data['menu_all'] = \App\Models\AdminMenu::with('SubMenu')->get();
        return view('Admin.admin',$data);
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
        $firstname      =    $request->input('firstname');
        $lastname       =    $request->input('lastname');
        $nickname       =    $request->input('nickname');
        $mobile         =    $request->input('mobile');
        $username       =    $request->input('username');
        $password       =    $request->input('password');
        $photo          =    $request->input('photo')[0];
        $new_password   =    \Hash::make($password);

        $validator = Validator::make($request->all(), [
            'username'  => 'required',
            'password'  => 'required',
            'mobile'    => 'required',
            'nickname'  => 'required',
            'firstname' => 'required',
            'lastname'  => 'required',
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert    = [

                    'username'  =>  $username,
                    'password'  =>  $new_password,
                    'mobile'    =>  $mobile,
                    'nickname'  =>  $nickname,
                    'firstname' =>  $firstname,
                    'lastname'  =>  $lastname,
                    'photo'     =>  $photo,
                ];
                \App\Models\AdminUser::insert($data_insert);
                \DB::commit();
                $return['status']   = 1;
                $return['content']  = 'Success';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status']   = 0;
                $return['content']  = 'Unsuccess'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'Add Data';
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
        return \App\Models\AdminUser::find($id);
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
        $firstname =   $request->input('firstname');
        $lastname  =   $request->input('lastname');
        $nickname  =   $request->input('nickname');
        $username  =   $request->input('username');
        $mobile    =   $request->input('mobile');
        $address   =   $request->input('address');
        $photo     =   $request->input('edit_photo')[0];

        $validator      = Validator::make($request->all(), [
            'mobile'    => 'required',
            'nickname'  => 'required',
            'firstname' => 'required',
            'lastname'  => 'required',
            'username'  => 'required',
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = [

                    'mobile'    =>  $mobile,
                    'nickname'  =>  $nickname,
                    'firstname' =>  $firstname,
                    'lastname'  =>  $lastname,
                    'username'  =>  $username,
                    'address'   =>  $address,
                    'photo'     =>  $photo,
                ];
                \App\Models\AdminUser::where('id',$id)->update($data_insert);
                \DB::commit();
                $return['status']   = 1;
                $return['content']  = 'Successful';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status']   = 0;
                $return['content']  = 'Unsuccessful'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }
        $return['title']      = 'Update Data';
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
            \App\Models\AdminUser::where('id',$id)->delete();
            \DB::commit();
            $return['status']  = 1;
            $return['content'] = 'Successful';
            $return['menus']   = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status']  = 0;
            $return['content'] = 'Unsuccessful'.$e->getMessage();;
        }
        $return['title'] = 'Delete Data';
        return json_encode($return);
    }

    public function ListAdmin(){
        $result = \App\Models\AdminUser::select();
        return \Datatables::of($result)
        ->addIndexColumn()
        ->editColumn('photo',function($rec){
            $str = '<img src="'.asset('uploads/admin/'.$rec->photo).'" alt="image" height="60px" width="60px">';
            return $str;
        })
        ->addColumn('action',function($rec){
            $permission = \AdminPermission::CheckPermission('AdminUser');
            if ($permission['U'] == 'T') {
                $update = '<button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="Edit">
                    <i class="ace-icon fa fa-edit bigger-120"></i>
                </button>';
            }else {
                
                $update = "";
            }
            if ($permission['D'] == 'T') {
                $delete = '
                <button  class="btn btn-xs btn-danger btn-condensed btn-delete btn-tooltip" data-id="'.$rec->id.'" data-rel="tooltip" title="Delete">
                    <i class="ace-icon fa fa-trash bigger-120"></i>
                </button>';
            }else {

                $delete = "";
            }

             $str= $update.'
                <button  data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-info btn-condensed btn-change-password btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="Change Password">
                    <i class="ace-icon fa fa-key bigger-120"></i>
                </button>
                <button  data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-info btn-condensed btn-change-permission btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="Authority">
                    <i class="ace-icon fa fa-lock bigger-120"></i>
                </button>
                '.$delete;  
                return $str;

            
        })->make(true);
    }

    public function change_password(Request $request){

        $current_password   =   $request->input('current_password');
        $new_password       =   $request->input('new_password');
        $NewPassword        =   \Hash::make($new_password);

        $validator = Validator::make($request->all(), [

            'new_password' => 'required'
        ]);
        if (!$validator->fails()) {
            $admin      =   \Auth::guard('admin')->user();
            $id         =   $admin->id;
            $password   =   $admin->password;  
            \DB::beginTransaction();
            try {
                $data_update    = [

                    'password'  =>    $NewPassword

                ];

                if (Hash::check($current_password, $password)) {
                    \App\Models\AdminUser::where('id',$id)->update($data_update);
                    \DB::commit();
                    $return['status']   = 1;
                    $return['content']  = 'Successful';                        
                } else {
                    $return['status']   = 1;
                    $return['content']  = 'Your current password not match';
                }
                
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Unsuccessful'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'Change Password';
        return json_encode($return);
    }

    public function GetPermission($id){
        $result = \App\Models\CrudPermission::where('admin_user_id',$id)->get();
        return $result;
    }

        public function SetPermission(Request $request){
        $user_id = $request->input('id');
        $read    = $request->input('read',null);
        $create  = $request->input('create');
        $edit    = $request->input('edit');
        $delete  = $request->input('delete');
        \DB::beginTransaction();
        try {
            \App\Models\CrudPermission::where('admin_user_id',$user_id)->update(['readed'=>'F','deleted'=>'F','created'=>'F','updated'=>'F']);
            if($read){
                foreach ($read as $key => $value) {
                    $data = [];
                    $result = \App\Models\CrudPermission::where('admin_user_id',$user_id)->where('menu_id',$value)->first();
                    if($result){
                        $data['readed'] = 'T';
                        $data['updated_at'] = date('Y-m-d H:i:s');
                        \App\Models\CrudPermission::where('admin_user_id',$user_id)->where('menu_id',$value)->update($data);
                    }else{
                        $data['menu_id'] = $value;
                        $data['readed'] = 'T';
                        $data['admin_user_id'] = $user_id;
                        $data['created_at'] = date('Y-m-d H:i:s');
                        $data['updated_at'] = date('Y-m-d H:i:s');
                        \App\Models\CrudPermission::insert($data);
                    }
                }
            }

            if($create){
                foreach ($create as $key => $value) {
                    $data   = [];
                    $result = \App\Models\CrudPermission::where('admin_user_id',$user_id)->where('menu_id',$value)->first();
                    if($result){
                        $data['created']    = 'T';
                        $data['updated_at'] = date('Y-m-d H:i:s');
                        \App\Models\CrudPermission::where('admin_user_id',$user_id)->where('menu_id',$value)->update($data);
                    }else{
                        $data['menu_id']       = $value;
                        $data['created']       = 'T';
                        $data['admin_user_id'] = $user_id;
                        $data['created_at']    = date('Y-m-d H:i:s');
                        $data['updated_at']    = date('Y-m-d H:i:s');
                        \App\Models\CrudPermission::insert($data);
                    }
                }
            }

            if($edit){
                foreach ($edit as $key => $value) {
                    $data   = [];
                    $result = \App\Models\CrudPermission::where('admin_user_id',$user_id)->where('menu_id',$value)->first();
                    if($result){
                        $data['updated']    = 'T';
                        $data['updated_at'] = date('Y-m-d H:i:s');
                        \App\Models\CrudPermission::where('admin_user_id',$user_id)->where('menu_id',$value)->update($data);
                    }else{
                        $data['menu_id']       = $value;
                        $data['updated']       = 'T';
                        $data['admin_user_id'] = $user_id;
                        $data['created_at']    = date('Y-m-d H:i:s');
                        $data['updated_at']    = date('Y-m-d H:i:s');
                        \App\Models\CrudPermission::insert($data);
                    }
                }
            }

            if($delete){
                foreach ($delete as $key => $value) {
                    $data = [];
                    $result = \App\Models\CrudPermission::where('admin_user_id',$user_id)->where('menu_id',$value)->first();
                    if($result){
                        $data['deleted']    = 'T';
                        $data['updated_at'] = date('Y-m-d H:i:s');
                        \App\Models\CrudPermission::where('admin_user_id',$user_id)->where('menu_id',$value)->update($data);
                    }else{
                        $data['menu_id']       = $value;
                        $data['deleted']       = 'T';
                        $data['admin_user_id'] = $user_id;
                        $data['created_at']    = date('Y-m-d H:i:s');
                        $data['updated_at']    = date('Y-m-d H:i:s');
                        \App\Models\CrudPermission::insert($data);
                    }
                }
            }
            \DB::commit();
            
            $return['status']  = 1;
            $return['content'] = 'Success';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status']  = 0;
            $return['content'] = 'Unsuccess'.$e->getMessage();;
        }
        \AdminPermission::InitSessionPermission();
        $return['title'] = 'Submit';
        return $return;
    }

}
