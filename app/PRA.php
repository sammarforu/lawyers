<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PRA extends Model
{
    protected $table = "p_r_as";
    protected $fillable = ['created_id', 'voucher_no', 'file_no', 'catagory_id', 'client_name', 'business_name', 'ntn', 'cnic', 'cell_no', 'reference_no', 'pra_id', 'pra_password', 'pra_pin', 'attachment'];

    public function biller(){
    	return $this->belongsTo('App\User', 'created_id');
    }

     public function office(){
     	return $this->belongsTo('App\Catagory', 'catagory_id');
     }
}
