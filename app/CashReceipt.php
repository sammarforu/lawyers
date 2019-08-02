<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashReceipt extends Model
{
   protected $fillable = ['account_head_id', 'date', 'voucher_no', 'amount'];
}
