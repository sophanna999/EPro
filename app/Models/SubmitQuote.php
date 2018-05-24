<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmitQuote extends Model
{
    protected $table 		= "submit_quotes";
    protected $primaryKey 	= "submit_quotes_id";

    public function User(){
    	return $this->hasOne('App\Models\User','id','retailer_id');
    }
    public function Retailer(){
        return $this->hasOne('App\Models\User','id','retailer_id');
    }
    public function Customer(){
        return $this->hasOne('App\Models\User','id','customer_id');
    }
    public function Request(){
    	return $this->hasOne('App\Models\Requests','request_id','request_id');
    }
    public function Quotation(){
    	return $this->hasOne('App\Models\Quotation','id','quotes_id');
    }
    public function RequestEstimate(){
        return $this->hasOne('App\Models\Request_Estimate','id','request_estimate_id');
    }
    public function QuotePromotion(){
        return $this->hasOne('App\Models\QuotePromotion','quote_id','quotes_id');
    }
}
