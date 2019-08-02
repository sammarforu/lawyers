<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Catagory extends Model
{
protected $fillable = [
    'catagory_code',
	'catagory_name'
	];


	public function products()
	{
	return $this->hasMany('App\Product', 'catagory_id');
	}
}
