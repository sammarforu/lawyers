<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Purchase extends Model
{
    protected $fillable = [
	'account_id',
	'warehouse_id',
	'date',
	'bill_no',
	'grn_no',
	'purchase_type',
	'due_date',
	'particulars'
	];
	
	public function purchase_details()
	{
		return $this->hasMany('App\PurchaseDetail', 'purchase_id');
	}

		public function parties()
	{
		return $this->belongsTo('App\Party', 'account_id');
	}
}
