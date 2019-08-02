<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryChallan extends Model
{
    protected $fillable = ['party_id','date','dcn_no','type', 'outward_gpn', 'status'];

    public function challan_details()
    {
    return $this->hasMany('App\DeliveryChallanDetail', 'challan_id');
    }
    
    public function parties(){
    	return $this->belongsTo('App\Party', 'party_id');
    }
}
