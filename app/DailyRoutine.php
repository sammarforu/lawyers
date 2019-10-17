<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyRoutine extends Model
{
    protected $table = "daily_routines";
    protected $fillable = ['created_id', 'voucher_no', 'task_date', 'catagori_id', 'client_name', 'business_name', 'cell_no', 'cnic', 'metter', 'status', 'task', 'attachment'];

    public function biller(){
    	return $this->belongsTo('App\User', 'created_id');
    }

     public function office(){
     	return $this->belongsTo('App\Catagory', 'catagori_id');
     }
}
