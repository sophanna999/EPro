<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $table 		= "post_request";
    protected $primaryKey 	= "request_id";

    public function scopeMyRequest($query,$customer_id){
    	$query->where('customer_id',$customer_id);
    	$query->withCount('SubmitQuote');
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
    public function Existing() {
      return $this->hasOne('App\Models\Existing','existing_id','ex_retailer');
    }
    public function Dwelling() {
      return $this->hasOne('App\Models\Dwellings','id','dwelling_type_id');
    }
    public function RequestPhoto() {
      return $this->hasMany('App\Models\Request_Photo','request_id','request_id');
    }
}
