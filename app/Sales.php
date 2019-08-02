<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $fillable = [
							'date',
							'invoice_no',
							'localExport',
							'biller',
							'sale_type',
							'sale_list',
							'sample_description',
							'dcn_no',
							'warehouse_id',
							'party_id',
							'due_date',
							'particulars'
						  ];
						  
	public function sale_details()
	{
	return $this->hasMany('App\SaleDetail', 'sale_id')->orderBy('id');
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
