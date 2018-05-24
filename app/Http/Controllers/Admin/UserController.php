<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['main_menu']  = 'user';
        $data['sub_menu']   = 'user';
        $data['title_page'] = 'Members Form';
        $data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
        return view('Admin.user',$data);
    }

    /**
     * View Edit Profile
     * @return html
     */
    public function profile(){
        $data['main_menu']  = 'profile';
        $data['sub_menu']   = 'profile';
        $data['title_page'] = 'Edit members information';
        $admin              = \Auth::guard('admin')->user();
        $data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
        $data['admin']      = \App\Models\AdminUser::find($admin->id);
        return view('Admin.user.profile',$data);
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
        $firstname      = $request->input('firstname');
        $lastname       = $request->input('lastname');
        $nickname       = $request->input('nickname');
        $mobile         = $request->input('mobile');
        $address        = $request->input('address');
        $email          = $request->input('email');
        $password       = $request->input('password');
        $new_password   = \Hash::make($password);

        $validator = Validator::make($request->all(), [
            'password'  => 'required',
            'mobile'    => 'required',
            'nickname'  => 'required',
            'firstname' => 'required',
            'lastname'  => 'required',
            'address'   => 'required',
            'email'     => 'required',
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'password'  =>  $new_password,
                    'mobile'    =>  $mobile,
                    'nickname'  =>  $nickname,
                    'firstname' =>  $firstname,
                    'lastname'  =>  $lastname,
                    'address'   =>  $address,
                    'email'     =>  $email,
                ];
                \App\Models\User::insert($data_insert);
                \DB::commit();
                $return['status']   = 1;
                $return['content']  = 'สำเร็จ';
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
        // $result = \App\Models\User::find($id);
        // return json_encode($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return \App\Models\User::find($id);
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
        $firstname  = $request->input('firstname');
        $lastname   = $request->input('lastname');
        $nickname   = $request->input('nickname');
        $mobile     = $request->input('mobile');
        $address    = $request->input('address');
        $email      = $request->input('email');

        $validator = Validator::make($request->all(), [
            'mobile'    => 'required',
            'nickname'  => 'required',
            'firstname' => 'required',
            'lastname'  => 'required',
            'address'   => 'required',
            'email'     => 'required',
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'mobile'    =>  $mobile,
                    'nickname'  =>  $nickname,
                    'firstname' =>  $firstname,
                    'lastname'  =>  $lastname,
                    'address'   =>  $address,
                    'email'     =>  $email,
                ];
                \App\Models\User::where('id',$id)->update($data_insert);
                \DB::commit();
                $return['status']   = 1;
                $return['content']  = 'Success';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status']   = 0;
                $return['content']  = 'Unsuccess'.$e->getMessage();;
            }
        }else{
            $return['status']   = 0;
        }
        $return['title']        = 'Add Data';
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
            \App\Models\User::where('id',$id)->delete();
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

    public function ListUser(){
        $result = \App\Models\User::select();
        return \Datatables::of($result)
        ->addIndexColumn()
        ->addColumn('action',function($rec){
            $str='
                <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="แก้ไข">
                    <i class="ace-icon fa fa-edit bigger-120"></i>
                </button>
                <button  data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-info btn-condensed btn-change-password btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="เปลี่ยนรหัส">
                    <i class="ace-icon fa fa-key bigger-120"></i>
                </button>
                <button  class="btn btn-xs btn-danger btn-condensed btn-delete btn-tooltip" data-id="'.$rec->id.'" data-rel="tooltip" title="ลบ">
                    <i class="ace-icon fa fa-trash bigger-120"></i>
                </button>
            ';
            return $str;
        })->make(true);
    }

    public function change_password(Request $request){
        $id             = $request->input('id');
        $password       = $request->input('password');
        $new_password   = \Hash::make($password);

        $validator      = Validator::make($request->all(), [
            'password'  => 'required'
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_update = [

                    'password'  =>$new_password
                ];
                \App\Models\AdminUser::where('id',$id)->update($data_update);
                \DB::commit();
                $return['status']   = 1;
                $return['content']  = 'Success';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status']   = 0;
                $return['content']  = 'Unsuccess'.$e->getMessage();
            }
        }else{
            $return['status']   = 0;
        }
        $return['title']        = 'Change Password';
        return json_encode($return);
    }

    public function UserUpdate(Request $request) {
        $firstname = $request->input('firstname');
        $lastname  = $request->input('lastname');
        $nickname  = $request->input('nickname');
        $mobile    = $request->input('mobile');
        $address   = $request->input('address');
        $username  = $request->input('username');
        $photo     = $request->input('photo');

        $validator = Validator::make($request->all(), [
            'username'  => 'required',
            'firstname' => 'required',
            'lastname'  => 'required',
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'address'       =>  $address,
                    'mobile'        =>  $mobile,
                    'nickname'      =>  $nickname,
                    'firstname'     =>  $firstname,
                    'lastname'      =>  $lastname,
                    'username'      =>  $username,
                    'photo'         =>  $photo[0],
                    'updated_at'    =>date("Y-m-d H:i:s"),
                ];
                \App\Models\AdminUser::where('id',\Auth::guard('admin')->user()->id)->update($data_insert);
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
        $return['title'] = 'Update Data';
        return json_encode($return);
    }
}