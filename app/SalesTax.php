<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesTax extends Model
{
    protected $table = "sales_taxes";
    protected $fillable = ['created_id', 'voucher_no', 'file_no', 'catagory_id', 'client_name', 'business_name', 'ntn', 'cnic', 'cell_no', 'type', 'fbr_id', 'fbr_password', 'fbr_pin'];


    public function biller(){
    	return $this->belongsTo('App\User', 'created_id');
    }

     public function office(){
     	return $this->belongsTo('App\Catagory', 'catagory_id');
     }
}
