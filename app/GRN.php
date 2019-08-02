<?php

namespace App;
use App\GRNDetails;
use App\Supplier;
use Illuminate\Database\Eloquent\Model;

class GRN extends Model
{
	protected $table = 'grns';
    protected $fillable = ['account_id','date','grn_no', 'status'];

    public function grn_details()
    {
    return $this->hasMany('App\GRNDetails', 'grn_id');
    }
    

    public function parties(){
    return $this->belongsTo('App\Party', 'account_id');
    }

   
}
