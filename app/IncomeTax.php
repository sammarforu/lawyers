<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeTax extends Model
{
    protected $table = "income_taxes";
    protected $fillable = ['created_id', 'voucher_no', 'file_no', 'catagory_id', 'client_name', 'ntn_no', 'business_name', 'cnic', 'cell_no', 'status', 'iris_id', 'iris_password', 'iris_pin', 'attachment'];

    public function biller(){
    	return $this->belongsTo('App\User', 'created_id');
    }

     public function office(){
     	return $this->belongsTo('App\Catagory', 'catagory_id');
     }
}
