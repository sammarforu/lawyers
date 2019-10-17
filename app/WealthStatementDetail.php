<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WealthStatementDetail extends Model
{
   protected $table = "wealth_statement_detail";
    protected $fillable = ['statement_id', 'detail'];
}
