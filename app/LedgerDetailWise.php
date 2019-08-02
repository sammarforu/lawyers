<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LedgerDetailWise extends Model
{
	protected $table = 'ledger_detail_wise';
    protected $fillable = [
	'purchase_id',
	'purchase_ret_id',
	'sale_id',
	'sale_ret_id',
	'dc_id',
	'purchasetax_id',
	'grn_id',
	'product_id',
	'party_id',
	'voucher_id',
	'bank_id',
	'invoice_no',
	'voucher_no',
	'voucher_type',
	'date',
	'quantity',
	'rate',
	'other',
	'debit',
	'credit'
	];

	public function products()
	{
	return $this->BelongsTo('App\Product', 'product_id');
	}

	public function banks()
    {
    return $this->BelongsTo('App\Banks', 'bank_id');
    }
}
