<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ConfirmedRetailerController extends Controller
{
    public function index(Request $request){
      $page                       = $request->input('page',1);
      $item_per_page              = 5;
      $data['title_page']         = 'Confirmed Retailer';
      $data['main_menu']          = 'customer';
      $data['submenu_menu']       = '';
      $data['id']                 = (($page-1)*$item_per_page)+1;
      $user                       = \Auth::guard('customer')->user();
      $data['user']               = $user;
      $data['request_data']       = \App\Models\SubmitQuote::with('User','Request','RequestEstimate.EstimateCommencement')
      ->where('submit_quotes.customer_id', $user->id)
      ->where('submit_quotes.status', 's')
      ->orderBy('submit_quotes.updated_at','desc')
      ->paginate($item_per_page);
      // return $data['request_data'];
      // dd($data['request_data']);
             //dd($data['request_data']);
    	return view('customer.confirmed_retailer',$data);
    }
    public function detail($id){

        $data['title_page']    = 'Confirmed Retailer Detail';
        $data['main_menu']     = 'customer';
        $data['submenu_menu']  = '';
        $data['id']            = 1;
        $data['user']          = \Auth::guard('customer')->user();
        // \App\Models\SubmitQuote::with('User','Request.Estimate','Quotation.Contract','RequestEstimate.EstimateCommencement')->find($id);
        $data['submit_quotes'] = \App\Models\SubmitQuote::with('Quotation','QuotePromotion','User.Contract','Customer','RequestEstimate.EstimateCommencement','Request.RequestPhoto')->find($id);
        // dd($data['submit_quotes']);
    	return view('customer.confirmed_retailer_detail',$data);
    }
}
