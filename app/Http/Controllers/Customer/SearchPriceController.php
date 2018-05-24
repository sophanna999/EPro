<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchPriceController extends Controller
{
    public function index(Request $request){
    	$type_id              = $request->input('type_id',null);
    	$keyword              = $request->input('keyword');
    	$page                 = $request->input('page',1);
        $item_per_page        = 5;
        $data['title_page']   = 'Search Price';
    	$data['main_menu']    = 'searchprice';
    	$data['submenu_menu'] = '';
        $data['type_id']      = $type_id;
    	$data['keyword']      = $keyword;
        $data['id']           = (($page-1)*$item_per_page)+1;
        $user                 = \Auth::guard('customer')->user();
    	$data['user']         = $user;
        if($keyword==null) {
        	if ($type_id==null) {
        		$data['lists']    = \App\Models\WeeklyPrice::orderBy('updated_at', 'DESC')->paginate($item_per_page);	
        	}else {
        		$data['lists']    = \App\Models\WeeklyPrice::where('weekly_price.type_id', $type_id )->orderBy('updated_at', 'DESC')->paginate($item_per_page);	
        	}
        } else {
            // \DB::enableQueryLog();
            if ($type_id==null) {
                $data['lists']   = \App\Models\WeeklyPrice::where('consumtion_start','like', '%' .$keyword. '%')
                ->orwhere('consumtion_end','like', '%' .$keyword. '%')
                ->orwhere('unit_price','like', '%' .$keyword. '%')
                ->orwhere('duration_from','like', '%' .$keyword. '%')
                ->orwhere('duration_end','like', '%' .$keyword. '%')
                ->orderBy('updated_at', 'DESC')->paginate($item_per_page);  
            }else {
                $data['lists']   = \App\Models\WeeklyPrice::where('weekly_price.type_id', $type_id)
                ->where(function($q) use($keyword){
                    $q->orWhere('duration_end','like', '%' .$keyword. '%');
                    $q->orWhere('consumtion_end','like', '%' .$keyword. '%');
                    $q->orWhere('unit_price','like', '%' .$keyword. '%');
                    $q->orWhere('duration_from','like', '%' .$keyword. '%');
                })
                ->orderBy('updated_at', 'DESC')->paginate($item_per_page);
            }
            // print_r(\DB::getQueryLog());
            // return json_encode($data);
        }
    	return view('customer.search_price',$data);
    }
}
