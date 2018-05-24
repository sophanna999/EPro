<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Validator;


class RetailerWaitingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu_all']   = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        $data['main_menu']  = 'RetailerSetting';
        $data['sub_menu']   = 'RetailerWaiting';
        $data['title_page'] = 'Retailer Form';
        $data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
        $data['permission'] = \AdminPermission::CheckPermission($data['main_menu']);
        return view('Admin.retailer_waiting',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         return \App\Models\Retailer::find($id);
    }

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

    public function ListRetailer()
    {
        $result = \App\Models\Retailer::where('type_id', 'R')->where('status', 'WA')->select()->orderBy('users.created_at','DESC');
        return \Datatables::of($result)
        ->addIndexColumn()
        ->addColumn('action',function($rec){
            $str='
                <button  class="btn btn-xs btn-info btn-condensed btn-changeStatus btn-tooltip" data-id="'.$rec->id.'" data-rel="tooltip" title="Approve">
                    <i class="ace-icon fa fa-check bigger-120"></i>
                </button>';
                $update = '<button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="Edit">
                    <i class="ace-icon fa fa-edit bigger-120"></i>
                </button>';
                $detail = '<button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-primary btn-condensed btn-detail btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="Detail">
                    <i class="ace-icon fa fa-eye bigger-120"></i>
                </button>';
            return $str.' '.$update.' '.$detail;
        })->make(true);
    }

    public function changeStatus($id) {
        \DB::beginTransaction();
        try {
            $data_update = [
                'status'        =>  'A',
                'updated_at'    =>  date('Y-m-d H:i:s'),
            ];
            \App\Models\Retailer::where('id',$id)->update($data_update);
            $user = \App\Models\User::where('id', $id)->first();
            \Mail::send('email.activate_retailer', $data_update, function($message) use ($user)
            {
                $message->from(env('MAIL_USERNAME') , 'Watt Price Solution');
                $message->to($user->email, $user->firstname)->subject('Activate User');
            });
            \DB::commit();
            $return['status']   = 1;
            $return['content']  = 'Success';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status']   = 0;
            $return['content']  = 'Unsuccess'.$e->getMessage();
        }
        $return['title']        = 'Retailer Approved';
        return json_encode($return);
    }
}
