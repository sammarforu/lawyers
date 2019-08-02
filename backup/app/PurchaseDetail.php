<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $fillable = [
							'purchase_id',
							'product_id',
							'tax_id',
							'quantity',
							'unit_cost',
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
	
	
}
