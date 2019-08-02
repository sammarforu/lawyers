<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Purchase extends Model
{
    protected $fillable = [
	'supplier_id',
	'date',
	'reference_no',
	];
	
	public function purchase_details()
	{
		return $this->hasMany('App\PurchaseDetail', 'purchase_id');
	}

		public function suppliers()
	{
		return $this->belongsTo('App\Supplier', 'supplier_id');
	}
}
