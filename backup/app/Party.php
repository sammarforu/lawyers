<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $fillable = [
	'party_name',
	'phone',
	'city',
	'address',
	'type'
	];
	
	public function party()
	{
	return $this->hasMany('App\SaleDetail');
	}
	
	public function ledgers()
	{
	return $this->hasMany('App\Ledger', 'party_id');
	}
}
