<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LCIndentor extends Model
{
    protected $fillable = ['indentor_name'];
    protected $table = "lc_indentors";
}
