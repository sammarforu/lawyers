<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $fillable = [
							'purchase_id',
							'party_id',
							'product_id',
							'tax_id',
							'uom_id',
							'warehouse_id',
							'quantity',
							'remaining_quantity',
							'unit_cost',
							'expiry',
							'total_cost'
						  ];
    public function purchase_tax()
	{
		return $this->belongsTo('App\Tax', 'tax_id');
	}
	
	public function purchase()
	{
		return $this->belongsTo('App\Purchase');
	}
	
	 public function products()
	{
		return $this->belongsTo('App\Product', 'product_id');
	}

	 public function unit()
	{
		return $this->belongsTo('App\UOM', 'uom_id');
	}

	 public function party()
	{
		return $this->belongsTo('App\Party', 'party_id');
	}

	
	
	
}
