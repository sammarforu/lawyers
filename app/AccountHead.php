<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountHead extends Model
{
    protected $fillable = ['account_group', 'title', 'account_no'];

    public function ledger_details()
    {
    	return $this->hasMany('App\GeneralVoucher', 'account_head_id');
    }
}
