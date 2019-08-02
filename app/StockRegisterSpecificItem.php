<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockRegisterSpecificItem extends Model
{
    protected $fillable = ['purchase_id', 'purchase_ret_id', 'sale_id', 'sale_ret_id', 'dc_id', 'grn_id', 'date', 'code', 'party_id', 'product_id', 'voucher_type', 'purchase_quantity', 'pur_ret_quantity', 'sale_quantity', 'sale_ret_quantity', 'cost_rate'];
}
