<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function Contract(){
    	return $this->hasOne('App\Models\Contract','retailer_id','id');
    }
}
