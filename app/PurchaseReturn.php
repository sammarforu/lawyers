<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseReturn extends Model
{
     protected $fillable = [
	'account_id',
	'date',
	'bill_no',
	'grn_no',
	'purchase_type',
	'due_date',
	'particulars'
	];
	
	public function purchase_return_detail()
	{
		return $this->hasMany('App\PurchaseReturnDetails', 'purchase_id');
	}

		public function parties()
	{
		return $this->belongsTo('App\Party', 'account_id');
	}

	 public function unit()
	{
		return $this->belongsTo('App\UOM', 'uom_id');
	}
}
