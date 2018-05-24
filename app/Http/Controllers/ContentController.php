<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ContentController extends Controller
{
    public function knowledge_hub(){
		$data['title_page']   = 'Knowledge Hub';
		$data['main_menu']    = 'knowledge_hub';
		$data['submenu_menu'] = '';
		return view('knowledge_hub',$data);
    }
}
