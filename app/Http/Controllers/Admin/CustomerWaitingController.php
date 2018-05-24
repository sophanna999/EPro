<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerWaitingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu_all'] = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        $data['main_menu'] = 'CustomerSetting';
        $data['sub_menu'] = 'CustomerWaiting';
        $data['title_page'] = 'Customer Form';
        $data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
        $data['permission'] = \AdminPermission::CheckPermission($data['main_menu']);
        return view('Admin.customer_waiting',$data);
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

    public function ListCustomer()
    {
        $result = \App\Models\Customers::where('type_id', 'C')->where('status', 'WA')->select();
        return \Datatables::of($result)
        ->addIndexColumn()
        ->addColumn('action',function($rec){
            $str='
                <button  class="btn btn-xs btn-info btn-condensed btn-changeStatus btn-tooltip" data-id="'.$rec->id.'" data-rel="tooltip" title="Approve">
                    <i class="ace-icon fa fa-check bigger-120"></i>
                </button>
            ';
            return $str;
        })->make(true);
    }

    public function changeStatus($id) {
        \DB::beginTransaction();
        try {
            $data_update    = [
                'status'        =>'A',
                'updated_at'    =>date('Y-m-d H:i:s'),
            ];
            \App\Models\Customers::where('id',$id)->update($data_update);
            \DB::commit();
            $return['status']   = 1;
            $return['content']  = 'Success';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status']   = 0;
            $return['content']  = 'Unsuccess'.$e->getMessage();
        }
        $return['title']        = 'Approve Status';
        return json_encode($return);
    }
}