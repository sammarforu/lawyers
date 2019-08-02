<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
protected $fillable = [
    'catagory_code',
	'catagory_name'
	];
}
