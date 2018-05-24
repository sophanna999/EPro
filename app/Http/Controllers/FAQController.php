<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FAQController extends Controller
{
    public function index(){
		$data['title_page']   = 'FAQ';
		$data['main_menu']    = 'faq';
		$data['submenu_menu'] = '';
		$data['lists']        = \App\Models\Faq::get();
    	return view('faq',$data);
    }
}
