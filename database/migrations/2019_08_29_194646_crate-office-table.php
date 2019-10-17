<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateOfficeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('catagories', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('catagory_code', 100);
            $table->string('catagory_name', 100);
            $table->timestamps();
        });

    Schema::create('system_logos', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('image', 250)->nullable();
            $table->timestamps();
        });

    Schema::create('settings', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('system_name', 100)->nullable();
            $table->string('title', 100)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('currency', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('footer_line', 200)->nullable();
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
