<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NTN extends Model
{
    protected $table = "n_t_ns";
    protected $fillable = ['created_id', 'voucher_no', 'ntn', 'catagory_id', 'client_name', 'cnic', 'business_name', 'cell_no', 'email', 'password', 'iris_id', 'iris_password', 'iris_pin', 'attachment'];

    public function biller(){
    	return $this->belongsTo('App\User', 'created_id');
    }

     public function office(){
     	return $this->belongsTo('App\Catagory', 'catagory_id');
     }
}
