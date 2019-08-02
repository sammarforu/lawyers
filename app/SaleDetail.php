<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
     protected $fillable = [
							'sale_id',
							'product_id',
							'party_id',
							'uom_id',
							'discount_id',
							'warehouse_id',
							'quantity',
							'product_cost',
							'cost_amount',
							'discount_id',
							'sale_rate',
							'sale_amount'
						  ];
						  
	public function products()
	{
	return $this->belongsTo('App\Product', 'product_id');
	}
	
	public function taxes()
	{
	return $this->belongsTo('App\Tax', 'tax_id');
	}
	
	public function discount()
	{
	return $this->belongsTo('App\Discount', 'discount_id');
	}
	
	public function parties()
	{
	return $this->belongsTo('App\Party', 'party_id');
	}
	
	public function ledger()
	{
	return $this->belongsTo('App\Ledger', 'party_id');
	}

	public function uoms()
	{
	return $this->belongsTo('App\UOM', 'uom_id');
	}

	 public function unit()
	{
		return $this->belongsTo('App\UOM', 'uom_id');
	}
	
	
}
