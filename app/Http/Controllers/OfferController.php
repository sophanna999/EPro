<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class OfferController extends Controller
{
    public function index(){
		$data['title_page']   = 'Offers';
		$data['main_menu']    = 'offer';
		$data['submenu_menu'] = '';
		$data['lists']        = \App\Models\PostOffer::orderBy('updated_at','desc')->paginate(4);
    	return view('offer',$data);
    }
}
