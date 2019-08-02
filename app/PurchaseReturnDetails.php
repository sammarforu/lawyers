<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseReturnDetails extends Model
{
     protected $fillable = [
							'purchase_id',
							'product_id',
							'uom_id',
							'quantity',
							'unit_cost',
							'total_cost'
						  ];
    public function purchase_tax()
	{
		return $this->belongsTo('App\Tax', 'tax_id');
	}
	
	public function purchaseReturn()
	{
		return $this->belongsTo('App\PurchaseReturn');
	}
	
	 public function products()
	{
		return $this->belongsTo('App\Product', 'product_id');
	}

	 public function unit()
	{
		return $this->belongsTo('App\UOM', 'uom_id');
	}

	
}
