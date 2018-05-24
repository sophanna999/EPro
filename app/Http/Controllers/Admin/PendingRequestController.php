<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Validator;

class PendingRequestController extends Controller
{
    public function index() {
        $data['menu_all']     = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        $data['main_menu']    = 'RequestSetting';
        $data['sub_menu']     = 'PendingRequest';
        $data['title_page']   = 'Approve Request Form';
        $data['menus']        = \App\Models\AdminMenu::ActiveMenu()->get();
        $data['permission']   = \AdminPermission::CheckPermission($data['main_menu']);
        $data['dwellings']    = \App\Models\Dwellings::get();
        $data['existing']     = \App\Models\Existing::get();
        $data['estimate']     = \App\Models\Estimate_Commencement::get();
        return view('Admin.pending_request',$data);
    }

    public function ListPendingRequest () {
    	$result = \App\Models\Requests::leftjoin('users', 'post_request.customer_id', '=', 'users.id')  ->where('post_request.status', 'W')
              ->select('users.firstname', 'users.lastname', 'users.id', 'post_request.*')->orderBy('post_request.created_at', 'DESC');
        return \Datatables::of($result)
        ->addIndexColumn()
        ->editColumn('customer_id', function($rec){
            $str = $rec->firstname.' '.$rec->lastname;
            return $str;
        })
        ->editColumn('type_id', function($rec){
            if ($rec->type_id == 1) {
            	return "Business";
            }else {
            	return "Residentail";
            }
        })
        ->editColumn('status', function($rec){
            if ($rec->status == "W") {
            	return "Pending";
            }else {
            	return "";
            }
        })
        ->addColumn('action',function($rec){
            $str='<button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-info btn-condensed btn-approve btn-tooltip" data-rel="tooltip" data-id="'.$rec->request_id.'" title="Approve">
                    <i class="ace-icon fa fa-check bigger-120"></i>
                </button>
                <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-danger btn-condensed btn-cancel btn-tooltip" data-rel="tooltip" data-id="'.$rec->request_id.'" title="Cancel">
                    <i class="ace-icon fa fa-times bigger-120"></i>
                </button>
                <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-warning btn-condensed btn-history btn-tooltip" data-rel="tooltip" data-id="'.$rec->id.'" title="History">
                    <i class="ace-icon fa fa-history bigger-120"></i>
                </button>
                <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-primary btn-condensed btn-detail btn-tooltip" data-rel="tooltip" data-id="'.$rec->request_id.'" title="Detail">
                    <i class="ace-icon fa fa-eye bigger-120"></i>
                </button>
                <button data-loading-text="<i class=\'fa fa-refresh fa-spin\'></i>" class="btn btn-xs btn-success btn-condensed btn-edit btn-tooltip" data-rel="tooltip" data-id="'.$rec->request_id.'" title="Edit">
                    <i class="ace-icon fa fa-edit bigger-120"></i>
                </button>
                ';
            return $str;
        })->make(true);
    }

    public function approve($id) {
        \DB::beginTransaction();
        try {
            $data_update = [
                'status'        =>  'O',
                'updated_at'    =>  date('Y-m-d H:i:s'),
            ];
            \App\Models\Requests::where('request_id',$id)->update($data_update);
            $test = array();
            $retailer = \App\Models\User::where('type_id', 'R')->whereNotNull('email')->get();
            foreach ($retailer as $key => $value) {
                $test['email'][] = $value->email;
                $test['firstname'][] = $value->firstname;
            }

            \Mail::send('email.approved_request',$data_update, function($message) use ($test)
                {
                    $message->from(env('MAIL_USERNAME') , 'Watt Price Solution');
                    $message->to('sophanna.tep@gmail.com','Sophanna')->subject('Approval Requests');
                    $message->bcc($test['email']);
                });

            \DB::commit();
            $return['status']   = 1;
            $return['content']  = 'Success';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status']   = 0;
            $return['content']  = 'Unsuccess'.$e->getMessage();
        }
        $return['title']        = 'Request Approved.';
        return json_encode($return);
    }
    public function CancelRequest($id) {
        \DB::beginTransaction();
        try {
            $data_update = [
                'status'        =>  'C',
                'updated_at'    =>  date('Y-m-d H:i:s'),
            ];
            \App\Models\Requests::where('request_id',$id)->update($data_update);
            \DB::commit();
            $return['status']   = 1;
            $return['content']  = 'Success';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status']   = 0;
            $return['content']  = 'Unsuccess'.$e->getMessage();
        }
        $return['title']        = 'Cancal Request';
        return json_encode($return);
    }

    public function GetRequest($id){
        $data['requests'] = \App\Models\Requests::where('customer_id',$id)->get();
        return $data['requests'];
    }
    public function GetRequestById($id){
        $data['requests'] = \App\Models\Requests::with('Existing','RequestEstimate.EstimateCommencement','RequestPhoto')->where('post_request.request_id',$id)->first();
        return $data['requests'];
    }

    public function update(Request $request, $id)
    {
        $type_id           = $request->type_id;
        $customer_id       = $request->input('customer_id');
        $random_request_id = $request->input('random_request_id');
        $request_id        = $request->input('request_id');
        $dwelling          = $request->input('dwellings');
        $company           = $request->input('company');
        $uen               = $request->input('uen');
        $premise_address   = $request->input('premise_address');
        $bill_address      = $request->input('bill_address');
        $avg               = $request->input('avg');
        $existing          = $request->input('existing');
        $price_model       = $request->input('price_model');
        $get_photo         = \App\Models\Request_Photo::where('request_id',$id)->get();

        if (!empty($request->file('photo_bill1'))) {
            $photo_bill1     = $request->file('photo_bill1');
            $bill_name1      = time().rand().'.'.$photo_bill1->getClientOriginalExtension();
            $destinationPath = public_path('uploads/requests/');
            $photo_bill1->move($destinationPath, $bill_name1);
            if(!empty($get_photo[0])) {
                \App\Models\Request_Photo::where('id',$get_photo[0]->id)->update(['photo_name'=>$bill_name1,'updated_at'=>date('Y-m-d H:i:s')]);
            } else {
                \App\Models\Request_Photo::insert(['request_id'=>$id, 'photo_name'=>$bill_name1, 'customer_id'=>$customer_id,'created_at'=>date('Y-m-d H:i:s')]);
            }
        }
        if (!empty($request->file('photo_bill2'))) {
            $photo_bill2     = $request->file('photo_bill2');
            $bill_name2      = time().rand().'.'.$photo_bill2->getClientOriginalExtension();
            $destinationPath = public_path('uploads/requests/');
            $photo_bill2->move($destinationPath, $bill_name2);
            if(!empty($get_photo[1])) {
                \App\Models\Request_Photo::where('id',$get_photo[1]->id)->update(['photo_name'=>$bill_name2,'updated_at'=>date('Y-m-d H:i:s')]);
            } else {
                \App\Models\Request_Photo::insert(['request_id'=>$id, 'photo_name'=>$bill_name2, 'customer_id'=>$customer_id,'created_at'=>date('Y-m-d H:i:s')]);
            }
        }

        \DB::beginTransaction();
        try {
            if($type_id==1) {
                $data = [
                    'type_id'               =>  $type_id,
                    'random_request_id'     =>  $random_request_id,
                    'dwelling_type_id'      =>  $dwelling,
                    'company_name'          =>  $company,
                    'uen_no'                =>  $uen,
                    'premise_address'       =>  $premise_address,
                    'bill_address'          =>  $bill_address,
                    'avr_consumtion'        =>  $avg,
                    'ex_retailer'           =>  $existing,
                    'customer_id'           =>  $customer_id,
                    'price'                 =>  0,
                    'updated_at'            =>  date('Y-m-d H:i:s'),
                ];
            } else {
                $data = [
                    'type_id'               =>  $type_id,
                    'random_request_id'     =>  $random_request_id,
                    'dwelling_type_id'      =>  $dwelling,
                    'premise_address'       =>  $premise_address,
                    'bill_address'          =>  $bill_address,
                    'avr_consumtion'        =>  $avg,
                    'ex_retailer'           =>  $existing,
                    'customer_id'           =>  $customer_id,
                    'price'                 =>  0,
                    'updated_at'            =>  date('Y-m-d H:i:s'),
                ];
            }
            \App\Models\Requests::where('request_id', $id)->update($data);
            \App\Models\Request_Estimate::where('request_id', $id)->delete();
            foreach ($price_model as $key => $value) {
                \App\Models\Request_Estimate::insert(['request_id'=>$id, 'estimate_id'=>$value,'created_at'=>date('Y-m-d H:i:s')]);
            }
            \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Successful';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Unsuccessful'.$e->getMessage();
            }
        // }else{
        //     $return['status'] = 0;
        //     $return['content'] = 'Unsuccessful'.$e->getMessage();
        // }
        $return['title'] = 'Update data';
        return json_encode($return);
    }

}
