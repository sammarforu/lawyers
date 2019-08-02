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
	'author',
	'product_cost',
	'product_price',
	'year'
	];
	
	public function products_detail()
	{
		return $this->hasMany('App\PurchaseDetail');
	}
	
	public function sale_detail()
	{
		return $this->hasMany('App\SaleDetail');
	}
	public function publisher_detail()
	{
	return $this->BelongsTO('App\Publisher', 'publisher_id');
	}
	
	public function publishers()
	{
	return $this->BelongsTo('App\Publisher', 'publisher_id');
	}
}
