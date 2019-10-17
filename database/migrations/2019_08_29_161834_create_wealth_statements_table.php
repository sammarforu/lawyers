<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWealthStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wealth_statements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('created_id')->unsigned();
            $table->string('voucher_no', 100);
            $table->string('client_name', 100);
            $table->integer('catagory_id')->unsigned();
            $table->string('cnic', 100);
            $table->string('income', 100);
            $table->string('expense', 100);
            $table->string('cash', 100);
            $table->string('bank_balance', 100);
            $table->string('gold', 100);
            $table->string('prize_bond', 100);
            $table->string('bike', 100);
            $table->string('attachment', 200)->nullable();
            $table->timestamps();
        });

        Schema::create('wealth_statement_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('statement_id')->unsigned();
            $table->string('detail', 200);
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
        Schema::dropIfExists('wealth_statements');
    }
}
