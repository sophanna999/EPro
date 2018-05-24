<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class KnowledgeController extends Controller
{
    public function lists(){
        $data['title_page']   = 'Knowledge Hub';
        $data['main_menu']    = 'knowledge_hub';
        $data['submenu_menu'] = '';
        $data['lists']        = \App\Models\Knowledge::orderBy('updated_at','desc')->paginate(4);
    	return view('knowledge_hub',$data);
    }
    public function detail($id){
        $data['title_page']   = 'Knowledge Hub';
        $data['main_menu']    = 'knowledge_hub';
        $data['submenu_menu'] = '';
        $data['detail']       = \App\Models\Knowledge::find($id);
    	return view('knowledge_hub_detail',$data);
    }
}
