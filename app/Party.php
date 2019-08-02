<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $fillable = [
	'account_group_id',
	'account_type',
	'party_name',
	'phone',
	'ntn',
	'strn',
	'city',
	'address'
	];
	

	
	public function purchase_detail()
	{
	return $this->hasMany('App\PurchaseDetail');
	}
	
	public function sale_detail()
	{
	return $this->hasMany('App\SaleDetail');
	}

	public function purchase_return_detail()
	{
	return $this->hasMany('App\PurchaseReturnDetails');
	}

	public function sale_return_detail()
	{
	return $this->hasMany('App\SaleReturnDetails');
	}

	public function products(){
		return $this->hasMany('App\Product');
	}

	public function general_vouchers()
	{
	return $this->hasMany('App\GeneralVoucher', 'account_head_id');
	}


	public function bank_payments()
	{
	return $this->hasMany('App\BankPayment', 'account_head_id');
	}

	public function cash_receipts()
	{
	return $this->hasMany('App\CashReceipt', 'account_head_id');
	}

	public function cash_payments()
	{
	return $this->hasMany('App\CashPayment', 'account_head_id');
	}

	public function cheque_payments()
	{
	return $this->hasMany('App\ChequePayment', 'account_head_id');
	}
}
