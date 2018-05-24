<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AboutController extends Controller
{
    public function index(){
		$data['title_page']   = 'About';
		$data['main_menu']    = 'about';
		$data['submenu_menu'] = '';
		$data['abouts']       = \App\Models\About::orderBy('id', 'DESC')->first();
		$data['services']     = \App\Models\Service::orderBy('id', 'DESC')->limit(3)->get();
    	return view('about',$data);
    }
    public function service($id){
    	$data['title_page']   = 'About';
		$data['main_menu']    = 'about';
		$data['submenu_menu'] = '';
		$data['services']     = \App\Models\Service::find($id);
    	return view('service',$data);
    }
}
