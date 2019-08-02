<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
	'name',
	'email',
	'phone',
	'company',
	'address',
	'city',
	'state',
	'country'
	];
}
