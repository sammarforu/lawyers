<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    protected $fillable = [
	'party_id',
	'date',
	'particulars',
	'bill_no',
	'debit',
	'credit'
	];
	
	public function ledger_party()
	{
	return $this->belongsTo('App\Party', 'party_id');
	}
}
