<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $fillable = [
	'tax_title',
	'tax_rate',
	'tax_type'
	];
}
