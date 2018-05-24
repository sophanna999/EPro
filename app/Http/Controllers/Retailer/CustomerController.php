<?php

namespace App\Http\Controllers\Retailer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index(Request $request){
        $status               = $request->input('status_type',null);
        $keyword              = $request->input('keyword');
        $page                 = $request->input('page', 1);
        $item_per_page        = 5;
        $data['title_page']   = 'Customer';
        $data['main_menu']    = 'retailer';
        $data['submenu_menu'] = '';
        $data['id']           = (($page-1)*$item_per_page)+1;
        $data['status']       = $status;
        $data['keyword']      = $keyword;
        $user                 = \Auth::guard('retailer')->user();
        $data['user']         = $user;
        if ($keyword == null) {
            if($status == null){
            $data['customer_data']   = \App\Models\ViewCustomer::leftjoin('users','submit_quotes.customer_id','=', 'users.id')
            ->leftjoin('post_request','submit_quotes.request_id','=', 'post_request.request_id')
            ->orderBy('submit_quotes.created_at','desc')
            ->select('submit_quotes.*','submit_quotes.status as substatus','users.*','post_request.*')
            ->where('submit_quotes.retailer_id',$user->id)
            ->paginate($item_per_page);
        }else{
            $data['customer_data']   = \App\Models\ViewCustomer::leftjoin('users','submit_quotes.customer_id','=', 'users.id')
            ->where('submit_quotes.retailer_id',$user->id)
            ->where('submit_quotes.status',$status)
            ->leftjoin('post_request','submit_quotes.request_id','=', 'post_request.request_id')
            ->orderBy('submit_quotes.created_at','desc')
            ->select('submit_quotes.*','submit_quotes.status as substatus','users.*','post_request.*')
            ->paginate($item_per_page);
         }
         
        }else {
            if ($status == null) {
                $data['customer_data']  = \App\Models\ViewCustomer::leftjoin('quotes','submit_quotes.quotes_id','=', 'quotes.id')
            ->leftjoin('post_request','submit_quotes.request_id','=', 'post_request.request_id')
            ->leftjoin('users','submit_quotes.customer_id','=', 'users.id')
            ->where('post_request.random_request_id','like', '%' .$keyword. '%')
            ->orWhere('users.firstname','like','%'.$keyword.'%')
            ->orWhere('users.lastname','like','%'.$keyword.'%')
            ->select('submit_quotes.*','submit_quotes.status as substatus','users.*','post_request.*')
            ->orderBy('submit_quotes.created_at', 'DESC')->paginate($item_per_page);  
            }else {
                $data['customer_data']  = \App\Models\ViewCustomer::leftjoin('quotes','submit_quotes.quotes_id','=', 'quotes.id')
            ->leftjoin('post_request','submit_quotes.request_id','=', 'post_request.request_id')
            ->leftjoin('users','submit_quotes.customer_id','=', 'users.id')
            ->where('submit_quotes.status', $status)
            ->where(function($q) use($keyword){
                $q->orWhere('post_request.random_request_id','like', '%' .$keyword. '%');
                $q->orWhere('users.firstname','like', '%' .$keyword. '%');
                $q->orWhere('users.lastname','like', '%' .$keyword. '%');
            })
            ->select('submit_quotes.*','submit_quotes.status as substatus','users.*','post_request.*')
            ->orderBy('submit_quotes.created_at', 'DESC')->paginate($item_per_page);
            }
        }
        // dd($data['customer_data']);
    	return view('retailer.customer',$data);
    }
    public function detail($id){
        $data['title_page']   = 'Customer Detail';
        $data['main_menu']    = 'retailer';
        $data['submenu_menu'] = '';
        $data['no']           = 1;
        $user                 = \Auth::guard('retailer')->user();
        $data['user']         = $user;
        $submit_quotes        = \App\Models\SubmitQuote::leftjoin('post_request','submit_quotes.request_id','=','post_request.request_id')
        ->leftjoin('users','submit_quotes.customer_id','=','users.id')
        ->leftjoin('existings','post_request.ex_retailer','=','existings.existing_id')
        ->find($id);
        $data['submit_quote_detail'] = $submit_quotes;
        $data['contracts']           = \App\Models\Contract::where('retailer_id',$user->id)->get();
        $request_estimate            = \App\Models\Request_Estimate::where('request_id',$submit_quotes->request_id)
        ->leftjoin('estimate_commencement','request_estimate.estimate_id','=','estimate_commencement.id')
        ->get();
        $data['request_estimate']  = $request_estimate;
        // dd($data['request_estimate']);
    	return view('retailer.customer_detail',$data);
    }
    
}
