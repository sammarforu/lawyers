<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountGroup extends Model
{
    protected $fillable = ['code', 'name'];

    public function parties(){
    	return $this->hasMany('App\Party', 'account_group_id');
    }
    public function general_vouchers()
	{
	return $this->hasMany('App\GeneralVoucher', 'account_head_id');
	}
}
