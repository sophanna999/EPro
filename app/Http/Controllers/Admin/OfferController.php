<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu_all']   = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        $data['main_menu']  = 'OfferMenu';
        $data['sub_menu']   = '';
        $data['title_page'] = 'Offers Form';
        $data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
        $data['permission'] = \AdminPermission::CheckPermission($data['main_menu']);
        return view('Admin.offers',$data);
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
        //
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
        return \App\Models\Offer::leftjoin('users', 'user_id', '=', 'id')->find($id);
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
        $edit_name              = $request->input('edit_name');
        $edit_title             = $request->input('edit_title');
        $edit_detail            = $request->input('edit_detail');
        $edit_promotion_start   = $request->input('edit_promotion_start');
        $edit_promotion_end     = $request->input('edit_promotion_end');
        $edit_contact_person    = $request->input('edit_contact_person');
        $edit_contact_number    = $request->input('edit_contact_number');
        $edit_contact_email     = $request->input('edit_contact_email');

        $validator = Validator::make($request->all(), [
            'edit_name'             => 'required',
            'edit_title'            => 'required',
            'edit_detail'           => 'required',
            'edit_promotion_start'  => 'required',
            'edit_promotion_end'    => 'required',
            'edit_contact_person'   => 'required',
            'edit_contact_number'   => 'required',
            'edit_contact_email'    => 'required',
        ]);
        if (!$validator->fails()) {
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'retailer_name'     =>$edit_name,
                    'title'             =>$edit_title,
                    'detail'            =>$edit_detail,
                    'promotion_start'   =>$edit_promotion_start,
                    'promotion_end'     =>$edit_promotion_end,
                    'contact_person'    =>$edit_contact_person,
                    'contact_number'    =>$edit_contact_number,
                    'contact_email'     =>$edit_contact_email,
                ];
                \App\Models\Offer::where('post_offer_id',$id)->update($data_insert);
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
            \App\Models\Offer::where('post_offer_id',$id)->delete();
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

    public function ListOffers()
    {
        $result = \App\Models\Offer::leftjoin('users', 'user_id','=', 'id')->select();
        return \Datatables::of($result)
        ->addIndexColumn()
        ->editColumn('user_id', function($rec){
            $str =  $rec->firstname .' '. $rec->lastname;
            return $str;
        })
        ->addColumn('action',function($rec){
            $str='
                <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->post_offer_id.'" title="Edit">
                    <i class="ace-icon fa fa-edit bigger-120"></i>
                </button>
                <button  class="btn btn-xs btn-danger btn-condensed btn-delete btn-tooltip" data-id="'.$rec->post_offer_id.'" data-rel="tooltip" title="Delete">
                    <i class="ace-icon fa fa-trash bigger-120"></i>
                </button>
            ';
            return $str;
        })->make(true);
    }
}
