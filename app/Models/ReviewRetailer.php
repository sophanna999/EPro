<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewRetailer extends Model
{
    protected $table 		= "review_retailer";
    protected $primaryKey 	= "id";

    public function retailer() {
    	return $this->hasOne('\App\Models\User','id','retailer_id');
    }
}
