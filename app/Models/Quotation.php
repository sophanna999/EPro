<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table 		= "quotes";
    protected $primaryKey 	= "id";

    public function Contract(){
    	return $this->hasOne('App\Models\Contract','retailer_id','retailer_id');
    }

    public function QuotePromotion() {
    	return $this->hasOne('App\Models\QuotePromotion','quote_id','id');
    }
    public function SubmitQuote(){
    	return $this->hasMany('App\Models\SubmitQuote','request_id','request_id');
    }
    public function Estimate(){
    	return $this->hasOne('App\Models\Estimate_Commencement','id','estimate_id');
    }

    public function RequestEstimate() {
      return $this->hasMany('App\Models\Request_Estimate','request_id','request_id');
    }
    public function User() {
      return $this->hasOne('App\Models\User','id','customer_id');
    }
    public function Quotes() {
      return $this->hasOne('App\Models\Quotation','id','quotes_id');
    }
    public function Requests() {
      return $this->hasOne('App\Models\Requests','request_id','request_id');
    }
}
