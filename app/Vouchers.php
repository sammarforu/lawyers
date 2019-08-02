<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model
{
    protected $fillable = ['account_from_id', 'account_id', 'voucher_no', 'voucher_date', 'v_type', 'biller'];

    public function voucher_details()
	{
	return $this->hasMany('App\GeneralVoucher', 'voucher_id')->orderBy('id');
	}
	
	 public function parties()
	 {
	 return $this->belongsTo('App\Party', 'account_id');
	 }
	
	// public function billers()
	// {
	// return $this->belongsTo('App\User', 'biller');
	// }
}
