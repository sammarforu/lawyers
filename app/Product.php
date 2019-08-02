<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
	'catagory_id',
	'publisher_id',
	'product_code',
	'product_name',
	'product_english',
	'uom',
	'type',
	'product_cost',
	'product_price',
	'tax',
	'alert',
	'year',
	'pack_type',
	'pack_weight'
	];
	
	public function products_detail()
	{
		return $this->hasMany('App\PurchaseDetail');
	}

	public function grn_detail()
	{
		return $this->hasMany('App\GRNDetails');
	}
	public function purchase_detail()
	{
		return $this->hasMany('App\PurchaseDetail');
	}
	
	public function sale_detail()
	{
	return $this->hasMany('App\SaleDetail');
	}

	public function challan_detail()
	{
	return $this->hasMany('App\DeliveryChallanDetail', 'product_id');
	}

	public function sale_return_detail()
	{
	return $this->hasMany('App\SaleReturnDetails', 'product_id');
	}

	public function purchase_return_detail()
	{
	return $this->hasMany('App\PurchaseReturnDetails', 'product_id');
	}

	public function publisher_detail()
	{
	return $this->BelongsTO('App\Publisher', 'publisher_id');
	}
	
	public function publishers()
	{
	return $this->BelongsTo('App\Publisher', 'publisher_id');
	}

	public function catagories()
	{
	return $this->BelongsTo('App\Catagory', 'catagory_id');
	}
	
	public function party()
	{
	return $this->hasMany('App\Party', 'account_group_id');
	}
}
