<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SubscribeController extends Controller
{
    public function index() {
    	$data['menu_all']  = \App\Models\AdminMenu::where('main_menu_id',0)->get();
        $data['main_menu'] = 'Subscribe';
        $data['sub_menu']   = '';
        $data['title_page'] = 'Subscribe';
        $data['menus']      = \App\Models\AdminMenu::ActiveMenu()->get();
        return view('Admin.subscribe',$data);
    }

    public function show() {
    	$result = \App\Models\Subscribe::select();
        return \Datatables::of($result)
        ->addIndexColumn()
        ->make(true);
    }
}
