<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
	'product_name',
	'weight',
	'price',
	'origin',
	'sales_tax'
	];
}
