<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('created_id')->unsigned();
            $table->string('voucher_no', 100);
            $table->string('client_name', 100);
            $table->string('cnic', 100);
            $table->string('business_name', 100);
            $table->string('cell_no', 100);
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
