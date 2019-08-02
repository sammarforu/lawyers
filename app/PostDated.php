<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostDated extends Model
{
	protected $table = "post-dated";
    protected $fillable = ['account_id', 'voucher_no', 'voucher_date', 'v_type', 'biller', 'status'];


  

	

	
}
