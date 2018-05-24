<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RequestQuotesController extends Controller
{
    public function index(){
		$data['title_page']   = 'Request Quotes';
		$data['main_menu']    = 'request_quotes';
		$data['submenu_menu'] = '';
    	return view('request_quotes',$data);
    }
}
