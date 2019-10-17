<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WealthStatement extends Model
{
     protected $table = "wealth_statements";
    protected $fillable = ['created_id', 'voucher_no', 'client_name', 'catagory_id',  'cnic', 'income',  'expense', 'cash', 'bank_balance', 'gold', 'prize_bond', 'bike', 'attachment'];


    public function biller(){
    	return $this->belongsTo('App\User', 'created_id');
    }

     public function office(){
     	return $this->belongsTo('App\Catagory', 'catagory_id');
     }

     public function statement_detail(){
     	return $this->hasMany('App\WealthStatementDetail', 'statement_id');
     }
}
