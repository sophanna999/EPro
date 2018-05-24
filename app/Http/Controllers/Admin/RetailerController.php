<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class RetailerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu_all'] = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        $data['main_menu'] = 'RetailerSetting';
        $data['sub_menu'] = 'Retailers';
        $data['title_page'] = 'Retailer Form';
        $data['menus'] = \App\Models\AdminMenu::ActiveMenu()->get();
        $data['permission'] = \AdminPermission::CheckPermission($data['main_menu']);
        return view('Admin.retailer',$data);
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
        $firstname  = $request->input('firstname');
        $lastname   = $request->input('lastname');
        $nickname   = $request->input('nickname');
        $mobile     = $request->input('mobile');
        $address     = $request->input('address');
        $email      = $request->input('email');
        $password   = $request->input('password');
        $new_password = \Hash::make($password);

        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'mobile' => 'required',
            'nickname' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'email' => 'required',
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'password'=>$new_password,
                    'mobile'=>$mobile,
                    'nickname'=>$nickname,
                    'firstname'=>$firstname,
                    'lastname'=>$lastname,
                    'address'=>$address,
                    'email'=>$email,
                    'type_id'=> 'R',
                ];
                \App\Models\Retailer::insert($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Success';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Unsuccess'.$e->getMessage();;
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
         return \App\Models\Retailer::find($id);
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
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $nickname = $request->input('nickname');
        $mobile = $request->input('mobile');
        $address = $request->input('address');
        $email = $request->input('email');

        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            // 'nickname' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            // 'address' => 'required',
            'email' => 'required',
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'mobile'=>$mobile,
                    'nickname'=>$nickname,
                    'firstname'=>$firstname,
                    'lastname'=>$lastname,
                    'address'=>$address,
                    'email'=>$email,
                ];
                \App\Models\Retailer::where('id',$id)->update($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Success';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Unsuccess'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'Update Data';
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
            \App\Models\Retailer::where('id',$id)->delete();
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

    public function ListRetailer()
    {
        $result = \App\Models\Retailer::where('type_id', 'R')->where('status', 'A')->select('users.*')->orderBy('created_at', 'DESC');
        return \Datatables::of($result)
        ->addIndexColumn()
        ->editColumn('firstname', function($rec){
            $str = $rec->firstname.' '.$rec->lastname;
            return $str;
        })
        ->addColumn('action',function($rec){
            $permission = \AdminPermission::CheckPermission('Retailers');
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
            $str= $update.' '.$delete;
            return $str;
        })->make(true);
    }

    public function changeStatus($id) {
        \DB::beginTransaction();
        try {
            $data_update = [
                'status'=>'A',
                'updated_at'=>date('Y-m-d H:i:s'),
            ];
            \App\Models\Retailer::where('id',$id)->update($data_update);
            \DB::commit();
            $return['status'] = 1;
            $return['content'] = 'Success';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status'] = 0;
            $return['content'] = 'Unsuccess'.$e->getMessage();
        }
        $return['title'] = 'Update Status';
        return json_encode($return);
    }
}
