<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GRNDetails extends Model
{
	protected $table = 'grn_details';
    protected $fillable = ['grn_id','product_id', 'uom_id', 'quantity','rate','amount'];

     public function products()
	{
		return $this->belongsTo('App\Product', 'product_id');
	}

	 public function unit()
	{
		return $this->belongsTo('App\UOM', 'uom_id');
	}
}
