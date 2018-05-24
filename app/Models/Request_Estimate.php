<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request_Estimate extends Model
{
    protected $table = 'request_estimate';
    protected $primaryKey = 'id';

    public function EstimateCommencement() {
      return $this->hasOne('App\Models\Estimate_Commencement','id','estimate_id');
    }
    public function SubmitQuote(){
    	return $this->hasOne('App\Models\SubmitQuote','request_estimate_id','id');	
    }
    // public function SubmitQuoteEsitmate(){
    // 	return $this->hasOne('App\Models\SubmitQuote','request_estimate_id','id');	
    // }
}
