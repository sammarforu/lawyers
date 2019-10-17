<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_taxes', function (Blueprint $table) {
             $table->increments('id');
            $table->integer('created_id')->unsigned();
            $table->string('voucher_no', 100);
            $table->string('file_no', 100);
            $table->string('catagory_id', 100);
            $table->string('client_name', 100);
            $table->string('business_name', 100);
            $table->string('ntn', 100);
            $table->string('cnic', 100);
            $table->string('cell_no', 100);
            $table->string('type', 100);
            $table->string('fbr_id', 100);
            $table->string('fbr_password', 100);
            $table->string('fbr_pin', 100);
            // $table->string('attachment', 100);
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
        Schema::dropIfExists('sales_taxes');
    }
}
