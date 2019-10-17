<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $table = "clients";
    protected $fillable = ['created_id', 'client_name', 'cnic', 'business_name', 'cell_no'];
}
