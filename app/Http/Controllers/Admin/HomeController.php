<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
    	$data['main_menu'] 	= 'dashboard';
    	$data['sub_menu'] 	= 'dashboard';
    	$data['title_page'] = 'Dashbaord Form';
    	$data['menus'] 		= \App\Models\AdminMenu::ActiveMenu()->get();
    	$data['retailers'] 		= \App\Models\User::where('type_id', 'R')->get()->count();
    	$data['customers'] 		= \App\Models\User::where('type_id', 'C')->get()->count();
    	$admin              = \Auth::guard('admin')->user();
        $data['admin']      = \App\Models\AdminUser::find($admin->id);
    	return view('Admin.index',$data);
    }
    // public function CustAndRetailer(){
    //     $result = \App\Models\User::select(\DB::raw('count("id") as amount'), 'type_id')->groupBy('type_id')->get();
    //     // dd($result);
    //     $data[0] = ['Customers', 'Retailers'];
    //     foreach ($result as $key => $value) {

    //         $data[$key + 1]  = [$value->type_id =='R' ? 'Retailer' : 'Customers' , $value->amount];
    //     }
    //     return json_encode($data);
    // }
}
