<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LCAccount extends Model
{
     protected $fillable = ['account_name'];
    protected $table = "lc_accounts";
}
