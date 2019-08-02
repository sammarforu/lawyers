<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $fillable = [
							'date',
							'reference_no',
							'biller',
							'party_id',
							'sale_type'
						  ];
						  
	public function sale_details()
	{
	return $this->hasMany('App\SaleDetail', 'sale_id');
	}
	
	public function parties()
	{
	return $this->belongsTo('App\Party', 'party_id');
	}
	
	public function billers()
	{
	return $this->belongsTo('App\User', 'biller');
	}
	
	public function ledgers()
	{
	return $this->hasMany('App\Ledger');
	}

	
}
