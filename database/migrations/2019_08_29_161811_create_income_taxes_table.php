<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomeTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('created_id')->unsigned();
            $table->string('voucher_no', 100);
            $table->string('file_no', 100);
            $table->string('catagory_id', 100);
            $table->string('client_name', 100);
            $table->string('ntn_no', 100);
            $table->string('business_name', 100);
            $table->string('cnic', 100);
            $table->string('cell_no', 100);
            $table->string('status', 100);
            $table->string('iris_id', 100);
            $table->string('iris_password', 100);
            $table->string('iris_pin', 100);
            $table->string('attachment', 200)->nullable();
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
        Schema::dropIfExists('income_taxes');
    }
}
