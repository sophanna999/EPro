<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function User(){
    	return $this->hasOne('\App\User','id','member_id');
    }
    public function Admin(){
    	return $this->hasOne('\App\Models\AdminUser','id','admin_id');
    }
}
