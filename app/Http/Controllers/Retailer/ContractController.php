<?php

namespace App\Http\Controllers\Retailer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Exception;

class ContractController extends Controller
{
    public function index(Request $request) {
    	$page                   = $request->input('page',1);
        $item_per_page          = 5;
    	$data['title_page']     = 'Contract Page';
    	$data['main_menu']      = 'retailer';
    	$data['submenu_menu']   = '';
    	$data['id']             = (($page-1)*$item_per_page)+1;
        $user                   = \Auth::guard('retailer')->user();
    	$data['user']           = $user;
        $contract               = \App\Models\Contract::where('retailer_id',$user->id)->orderBy('created_at', 'DESC')->paginate($item_per_page);
    	$data['lists']          = $contract;
    	return view('retailer.contract', $data);
    }
    public function create(){

    	$data['title_page']    = 'Contract Form';
    	$data['main_menu']     = 'Contract';
    	$data['submenu_menu']  = '';
    	$data['user']          = \Auth::guard('retailer')->user();
    	return view('retailer.create_contract',$data);
    }
    public function fileUpload(Request $request) {
        $return = [];
        try {
            $contract_name   = $request->input('contract_name');
            if ($request->hasFile('contract_file')) {
                $user            = \Auth::guard('retailer')->user();
                $image           = $request->file('contract_file');
                $name            = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('uploads/contracts/');
                $image->move($destinationPath, $name);
                
                $contract_amount = \App\Models\Contract::where('retailer_id', $user->id)->count();
                $data_insert = [
                            'retailer_id'   =>  $user->id,
                            'contract_name' =>  $contract_name,
                            'file_name'     =>  $name,
                            'created_at'    =>  date('Y-m-d H:i:s')
                        ];
                if ($contract_name != null && $image != null) {
                    if ($contract_amount < 1) {
                         $result = \App\Models\Contract::insert($data_insert);
                            if ($result) {
                                \DB::commit();
                                $return['title']       = 'Terms and Conditions Document Updated';
                                $return['status']   = 1;
                                $return['content']  = 'Terms and Conditions Document Updated';
                            }else {
                            throw new Exception("Contract documents Exist");
                            }
                        }else{
                            throw new Exception("Contract documents Exist");
                        }
                    }else {
                        throw new Exception("Should be enter title and File first");
                    }
                } else {
                    throw new Exception('Should be enter title and File first');
                }
            } catch (Exception $e) {
                \DB::rollBack();
                $return['title'] = 'Upload Error';
                $return['status']   = 0;
                $return['content']  = $e->getMessage();
            }
            
        return json_encode($return);     
}

    public function SubmitContract(Request $request){
		$contract_name  = $request->input('contract_name');
		$contract_image = $request->file('contract_image');
		// return $contract_image;

        $validator  = Validator::make($request->all(), [
            'contract_name'    => 'required',
            'contract_image'   => 'required',
        ]);
        if (!$validator->fails()) {
        	$user = \Auth::guard('retailer')->user();
            \DB::beginTransaction();
            try {
                $data_insert = [
					'retailer_id'   =>  $user->id,
					'contract_name' =>  $contract_name,
					'file_name'     =>  $contract_image,
					'created_at' 	=>  date('Y-m-d H:i:s')
                ];
                \App\Models\Contract::insert($data_insert);
                \DB::commit();
                $return['status']   = 1;
                $return['content']  = 'Successful';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status']   = 0;
                $return['content']  = 'Unsuccessful'.$e->getMessage();;
            }
        }else{
            $return['status']   = 0;
        }
        $return['title']        = 'Terms and Conditions Document Updated';
        return json_encode($return);
    }
    public function destroy($id)
    {
        \DB::beginTransaction();
        try {
            \App\Models\Contract::where('id',$id)->delete();
            \DB::commit();
            $return['status']   = 1;
            $return['content']  = 'Successful';
        } catch (Exception $e) {
            \DB::rollBack();
            $return['status']   = 0;
            $return['content']  = 'Unsuccessful'.$e->getMessage();;
        }
        $return['title']        = 'Delete Data';
        return json_encode($return);
    }
}
