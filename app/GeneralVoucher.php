<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralVoucher extends Model
{
    protected $fillable = ['sale_id', 'purchase_id', 'sale_ret_id', 'purchase_ret_id', 'dc_id', 'purchasetax_id', 'invoice_no', 'account_head_id', 'voucher_id', 'bank_id', 'date', 'voucher_no', 'cheque_no', 'v_type', 'narration', 'debit', 'credit'];


    public function banks()
    {
    return $this->BelongsTo('App\Banks', 'bank_id');
    }

    public function parties()
    {
    return $this->BelongsTo('App\Party', 'account_head_id');
    }
}
