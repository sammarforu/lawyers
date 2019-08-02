<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseTax extends Model
{
	protected $table = "purchase_taxes";
    protected $fillable = ['date', 'voucher_no','purchase_type', 'invoice_no', 'remarks', 'biller', 'party_id'];

        public function purchasetax_details()
	{
	return $this->hasMany('App\PurchaseTaxDetails', 'purchase_id');
	}

	

	public function parties()
	{
	return $this->belongsTo('App\Party', 'party_id');
	}

	
	
	public function billers()
	{
	return $this->belongsTo('App\User', 'biller');
	}
}
