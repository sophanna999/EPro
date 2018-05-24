<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SalesReportController extends Controller
{
    public function pay(){
    	return view('Admin.SalesReport.pay');
    }
}
