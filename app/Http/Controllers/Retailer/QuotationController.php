<?php

namespace App\Http\Controllers\Retailer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class QuotationController extends Controller
{
    public function index(Request $request){
    	$page                  = $request->input('page', 1);
        $item_per_page         = 5;
    	$data['title_page']    = 'quotation';
    	$data['main_menu']     = 'quotation';
        $data['submenu_menu']  = '';
    	$data['id']            = (($page-1)*$item_per_page)+1;
        $user                  = \Auth::guard('retailer')->user();
    	$data['user']          =  $user;
        $data['quote_data']    = \App\Models\Quotation::leftjoin('users', 'quotes.retailer_id', '=', 'users.id')->orderBy('quotes.updated_at','desc')->paginate($item_per_page);
    	return view('retailer.quotation',$data);

    }
    public function create(){

    	$data['title_page']    = 'Quotation Form';
    	$data['main_menu']     = 'quotations';
    	$data['submenu_menu']  = '';
    	$data['user']          = \Auth::guard('retailer')->user();
    	return view('retailer.create_quotation',$data);
    }
    public function CreateLow(Request $request) {

    	$quotes_name        = $request->input('quotes_name');
		$energy_rate 		= $request->input('energy_rate');
		$mdsc 		 		= $request->input('mdsc');
		$mdsc_value 		= $request->input('mdsc_value');
		$uos 				= $request->input('uos');
		$uos_value 			= $request->input('uos_value');
		$total_rate 		= $request->input('total_rate');
		$meter_charge 		= $request->input('meter_charge');
		$billing_charge 	= $request->input('billing_charge');
		$collection_charge  = $request->input('collection_charge');
		$payment_term 		= $request->input('payment_term');
		$detail 		    = $request->input('detail');

        $validator  = Validator::make($request->all(), [
            'quotes_name'  			=> 'required',
            'energy_rate'    		=> 'required',
            'total_rate'        	=> 'required',
            'meter_charge'     		=> 'required',
            'billing_charge'    	=> 'required',
            'collection_charge'     => 'required',
            'payment_term'      	=> 'required',
            'detail'      			=> 'required'
        ]);
        if (!$validator->fails()) {
            $user = \Auth::guard('retailer')->user();
            $retailer_id = $user->id;
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'retailer_id'           => $retailer_id,
                    'quotes_name'           => $quotes_name,
                    'type_tension_id'       => 1,
                    'energy_rate'           => $energy_rate,
                    'mdsc'            		=> $mdsc,
                    'mdsc_value'         	=> $mdsc_value,
                    'uos'          			=> $uos,
                    'uos_value'          	=> $uos_value,
                    'pso'          			=> 0,
                    'pso_value'          	=> 0,
                    'emc'          			=> 0,
                    'emc_value'          	=> 0,
                    'meuc'          		=> 0,
                    'meuc_value'          	=> 0,
                    'afp'          			=> 0,
                    'afp_value'          	=> 0,
                    'total_rate'          	=> $total_rate,
                    'meter_charge'          => $meter_charge,
                    'billing_charge'        => $billing_charge,
                    'collection_charge'     => $collection_charge,
                    'payment_term'          => $payment_term,
                    'detail'          		=> $detail,
                    'created_at'          	=> date('Y-m-d H:i:s'),
                ];
                \App\Models\Quotation::insert($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Successful';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Unsuccessful'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'Insert Data';
        return json_encode($return);
    }

     public function CreateHight(Request $request) {

    	$h_quotes_name         = $request->input('h_quotes_name');
		$h_energy_rate 		   = $request->input('h_energy_rate');
		$h_mdsc 		 	   = $request->input('h_mdsc');
		$h_mdsc_value 		   = $request->input('h_mdsc_value');
		$h_uos 				   = $request->input('h_uos');
		$h_uos_value 		   = $request->input('h_uos_value');
		$pso 				   = $request->input('pso');
		$pso_value 			   = $request->input('pso_value');
		$emc 			       = $request->input('emc');
		$emc_value 			   = $request->input('emc_value');
		$meuc 			       = $request->input('meuc');
		$meuc_value 		   = $request->input('meuc_value');
		$afp 				   = $request->input('afp');
		$afp_value 			   = $request->input('afp_value');
		$h_total_rate 		   = $request->input('h_total_rate');
		$h_meter_charge 	   = $request->input('h_meter_charge');
		$h_billing_charge 	   = $request->input('h_billing_charge');
		$h_collection_charge   = $request->input('h_collection_charge');
		$h_payment_term 	   = $request->input('h_payment_term');
		$h_detail 		       = $request->input('h_detail');

        $validator  = Validator::make($request->all(), [
            'h_quotes_name'  			=> 'required',
            'h_energy_rate'    			=> 'required',
            'h_total_rate'      		=> 'required',
            'h_meter_charge'      		=> 'required',
            'h_billing_charge'      	=> 'required',
            'h_collection_charge'      	=> 'required',
            'h_payment_term'      		=> 'required',
            'h_detail'      			=> 'required',
        ]);
        if (!$validator->fails()) {
            $user = \Auth::guard('retailer')->user();
            $retailer_id = $user->id;
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'retailer_id'           => $retailer_id,
                    'quotes_name'           => $h_quotes_name,
                    'type_tension_id'       => 2,
                    'energy_rate'           => $h_energy_rate,
                    'mdsc'            		=> $h_mdsc,
                    'mdsc_value'         	=> $h_mdsc_value,
                    'uos'          			=> $h_uos,
                    'uos_value'          	=> $h_uos_value,
                    'pso'          			=> $pso,
                    'pso_value'          	=> $pso_value,
                    'emc'          			=> $emc,
                    'emc_value'          	=> $emc_value,
                    'meuc'          		=> $meuc,
                    'meuc_value'          	=> $meuc_value,
                    'afp'          			=> $afp,
                    'afp_value'          	=> $afp_value,
                    'total_rate'          	=> $h_total_rate,
                    'meter_charge'          => $h_meter_charge,
                    'billing_charge'        => $h_billing_charge,
                    'collection_charge'     => $h_collection_charge,
                    'payment_term'          => $h_payment_term,
                    'detail'          		=> $h_detail,
                    'created_at'          	=> date('Y-m-d H:i:s'),
                ];
                \App\Models\Quotation::insert($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Successful';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Unsuccessful'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'Insert Data';
        return json_encode($return);
    }

    public function edit($id) {
        $data['title_page']    = 'Quotation';
        $data['main_menu']     = 'quotation';
        $data['submenu_menu']  = '';
        $data['quote_data']    = \App\Models\Quotation::find($id);
        $data['user']          = \Auth::guard('retailer')->user();
        return view('retailer.edit_quote',$data);
    }
    public function updateLow(Request $request, $id) {
        $quotes_name        = $request->input('quotes_name');
        $energy_rate        = $request->input('energy_rate');
        $mdsc               = $request->input('mdsc');
        $mdsc_value         = $request->input('mdsc_value');
        $uos                = $request->input('uos');
        $uos_value          = $request->input('uos_value');
        $total_rate         = $request->input('total_rate');
        $meter_charge       = $request->input('meter_charge');
        $billing_charge     = $request->input('billing_charge');
        $collection_charge  = $request->input('collection_charge');
        $payment_term       = $request->input('payment_term');
        $detail             = $request->input('detail');

        $validator  = Validator::make($request->all(), [
            'quotes_name'           => 'required',
            'energy_rate'           => 'required',
            'total_rate'            => 'required',
            'meter_charge'          => 'required',
            'billing_charge'        => 'required',
            'collection_charge'     => 'required',
            'payment_term'          => 'required',
            'detail'                => 'required'
        ]);
        if (!$validator->fails()) {
            $user = \Auth::guard('retailer')->user();
            $retailer_id = $user->id;
            \DB::beginTransaction();
            try {
                if ($uos == 1) {
                    $uos_value = "";
                }
                if ($mdsc) {
                    $mdsc_value = "";
                }

                $data_insert = [
                    'retailer_id'           => $retailer_id,
                    'quotes_name'           => $quotes_name,
                    'type_tension_id'       => 1,
                    'energy_rate'           => $energy_rate,
                    'mdsc'                  => $mdsc,
                    'mdsc_value'            => $mdsc_value,
                    'uos'                   => $uos,
                    'uos_value'             => $uos_value,
                    'pso'                   => 0,
                    'pso_value'             => 0,
                    'emc'                   => 0,
                    'emc_value'             => 0,
                    'meuc'                  => 0,
                    'meuc_value'            => 0,
                    'afp'                   => 0,
                    'afp_value'             => 0,
                    'total_rate'            => $total_rate,
                    'meter_charge'          => $meter_charge,
                    'billing_charge'        => $billing_charge,
                    'collection_charge'     => $collection_charge,
                    'payment_term'          => $payment_term,
                    'detail'                => $detail,
                    'created_at'            => date('Y-m-d H:i:s'),
                ];
                \App\Models\Quotation::where('quotes_id', $id)->update($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Successful';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Unsuccessful'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'Update Data';
        return json_encode($return);
    }
    public function updateHight(Request $request, $id) {

        $h_quotes_name         = $request->input('h_quotes_name');
        $h_energy_rate         = $request->input('h_energy_rate');
        $h_mdsc                = $request->input('h_mdsc');
        $h_mdsc_value          = $request->input('h_mdsc_value');
        $h_uos                 = $request->input('h_uos');
        $h_uos_value           = $request->input('h_uos_value');
        $pso                   = $request->input('pso');
        $pso_value             = $request->input('pso_value');
        $emc                   = $request->input('emc');
        $emc_value             = $request->input('emc_value');
        $meuc                  = $request->input('meuc');
        $meuc_value            = $request->input('meuc_value');
        $afp                   = $request->input('afp');
        $afp_value             = $request->input('afp_value');
        $h_total_rate          = $request->input('h_total_rate');
        $h_meter_charge        = $request->input('h_meter_charge');
        $h_billing_charge      = $request->input('h_billing_charge');
        $h_collection_charge   = $request->input('h_collection_charge');
        $h_payment_term        = $request->input('h_payment_term');
        $h_detail              = $request->input('h_detail');

        $validator  = Validator::make($request->all(), [
            'h_quotes_name'             => 'required',
            'h_energy_rate'             => 'required',
            'h_total_rate'              => 'required',
            'h_meter_charge'            => 'required',
            'h_billing_charge'          => 'required',
            'h_collection_charge'       => 'required',
            'h_payment_term'            => 'required',
            'h_detail'                  => 'required',
        ]);
        if (!$validator->fails()) {
            $user = \Auth::guard('retailer')->user();
            $retailer_id = $user->id;
            \DB::beginTransaction();
            try {
                if ($h_mdsc == 1) {

                    $h_mdsc_value = "";
                }
                if ($h_uos == 1) {
                    
                    $h_uos_value = "";
                }
                if ($pso == 1) {
                    
                    $pso_value = "";
                }
                if ($emc == 1) {
                    
                    $emc_value = "";
                }
                if ($meuc == 1) {
                    
                    $meuc_value = "";
                }
                if ($afp == 1) {
                    
                    $afp_value = "";
                }
                $data_insert = [
                    'retailer_id'           => $retailer_id,
                    'quotes_name'           => $h_quotes_name,
                    'type_tension_id'       => 2,
                    'energy_rate'           => $h_energy_rate,
                    'mdsc'                  => $h_mdsc,
                    'mdsc_value'            => $h_mdsc_value,
                    'uos'                   => $h_uos,
                    'uos_value'             => $h_uos_value,
                    'pso'                   => $pso,
                    'pso_value'             => $pso_value,
                    'emc'                   => $emc,
                    'emc_value'             => $emc_value,
                    'meuc'                  => $meuc,
                    'meuc_value'            => $meuc_value,
                    'afp'                   => $afp,
                    'afp_value'             => $afp_value,
                    'total_rate'            => $h_total_rate,
                    'meter_charge'          => $h_meter_charge,
                    'billing_charge'        => $h_billing_charge,
                    'collection_charge'     => $h_collection_charge,
                    'payment_term'          => $h_payment_term,
                    'detail'                => $h_detail,
                    'created_at'            => date('Y-m-d H:i:s'),
                ];
                \App\Models\Quotation::where('quotes_id', $id)->update($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Successful';
            } catch (Exception $e) {
                \DB::rollBack();
                $return['status'] = 0;
                $return['content'] = 'Unsuccessful'.$e->getMessage();;
            }
        }else{
            $return['status'] = 0;
        }
        $return['title'] = 'Update Data';
        return json_encode($return);
    }
}
