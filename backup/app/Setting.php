<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = 
	[
	'system_name',
	'title',
	'address',
	'phone',
	'email',
	'currency',
	'city',
	'state',
	'country',
	'footer_line'
	];
}
