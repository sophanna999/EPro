<?php

namespace App\Http\Controllers\Retailer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class WeeklyPriceController extends Controller
{
    public function index(Request $request){
        $page                  = $request->input('page', 1);
        $item_per_page         = 5;
    	$data['title_page']    = 'Weekly Price';
    	$data['main_menu']     = 'Weekly Price';
        $data['submenu_menu']  = '';
    	$data['id']            = (($page-1)*$item_per_page)+1;
        $data['user']          = \Auth::guard('retailer')->user();
    	$data['weekly_data']   = \App\Models\WeeklyPrice::orderBy('updated_at','desc')->paginate($item_per_page);
    	return view('retailer.weekly_price',$data);
    }
    public function create(){
    	$data['title_page']    = 'Weekly Price';
    	$data['main_menu']     = 'Weekly Price';
    	$data['submenu_menu']  = '';
    	$data['user']          = \Auth::guard('retailer')->user();
    	return view('retailer.create_weekly_price',$data);
    }
    public function edit($id){
    	$data['title_page']    = 'Weekly Price';
    	$data['main_menu']     = 'Weekly Price';
    	$data['submenu_menu']  = '';
        $data['price_data']    = \App\Models\WeeklyPrice::find($id);
        $data['user']          = \Auth::guard('retailer')->user();

    	return view('retailer.edit_weekly_price',$data);
    }
    public function CreatePrice(Request $request) {

        $type_id                = $request->input('type_id');
        $consumtion_start       = $request->input('consumtion_start');
        $consumtion_end         = $request->input('consumtion_end');
        $unit_price             = $request->input('unit_price');
        $duration_from          = $request->input('duration_from');
        $duration_end           = $request->input('duration_end');

        $validator  = Validator::make($request->all(), [
            'consumtion_start'  => 'required',
            'consumtion_end'    => 'required',
            'unit_price'        => 'required',
            'duration_from'     => 'required',
            'duration_end'      => 'required',
        ]);
        if (!$validator->fails()) {
            $user = \Auth::guard('retailer')->user();
            $retailer_id = $user->id;
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'retailer_id'           => $retailer_id,
                    'type_id'               => $type_id,
                    'consumtion_start'      => $consumtion_start,
                    'consumtion_end'        => $consumtion_end,
                    'unit_price'            => $unit_price,
                    'duration_from'         => $duration_from,
                    'duration_end'          => $duration_end
                ];
                \App\Models\WeeklyPrice::insert($data_insert);
                \DB::commit();
                $return['status'] = 1;
                $return['content'] = 'Successful';
                $return['menus'] = \App\Models\AdminMenu::where('main_menu_id',0)->get();
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
    public function update(Request $request, $id){

        $type_id                = $request->input('type_id');
        $consumtion_start       = $request->input('consumtion_start');
        $consumtion_end         = $request->input('consumtion_end');
        $unit_price             = $request->input('unit_price');
        $duration_from          = $request->input('duration_from');
        $duration_end           = $request->input('duration_end');

        $validator = Validator::make($request->all(), [
            'consumtion_start'  => 'required',
            'consumtion_end'    => 'required',
            'unit_price'        => 'required',
            'duration_from'     => 'required',
            'duration_end'      => 'required',
        ]);
        if (!$validator->fails()) {
            $user = \Auth::guard('retailer')->user();
            $retailer_id = $user->id;
            \DB::beginTransaction();
            try {
                $data_insert = [
                    'retailer_id'           => $retailer_id,
                    'type_id'               => $type_id,
                    'consumtion_start'      => $consumtion_start,
                    'consumtion_end'        => $consumtion_end,
                    'unit_price'            => $unit_price,
                    'duration_from'         => $duration_from,
                    'duration_end'          => $duration_end
                ];
                \App\Models\WeeklyPrice::where('weekly_price_id',$id)->update($data_insert);
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
        $return['title'] = 'Edit Data';
        return json_encode($return);
    }
}
