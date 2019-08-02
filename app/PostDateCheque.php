<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostDateCheque extends Model
{
    protected $table = "post-dated-cheques";
    protected $fillable = ['voucher_id', 'account_head_id', 'date', 'voucher_no', 'cheque_no', 'v_type', 'status', 'bank_id', 'narration', 'debit', 'credit'];

    public function post_dated()
	{
	return $this->BelongsTo('App\PostDated', 'voucher_id');
	}
    
    public function banks()
	{
	return $this->BelongsTo('App\Banks', 'bank_id');
	}

	public function party()
	{
	return $this->BelongsTo('App\Party', 'account_head_id');
	}


}
