<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLcAllDataMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('lc_indentors', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('indentor_name', 200);
            $table->timestamps();
        });

       Schema::create('lc_accounts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('account_name', 200);
            $table->timestamps();
        });

       Schema::create('lc_locations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('location_name', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
