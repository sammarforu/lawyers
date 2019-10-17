<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_routines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('created_id')->unsigned();
            $table->string('voucher_no', 100);
            $table->string('task_date', 100);
            $table->string('catagori_id', 100);
            $table->string('client_name', 100);
            $table->string('business_name', 100);
            $table->string('cell_no', 100);
            $table->string('cnic', 100);
            $table->string('metter', 100);
            $table->string('status', 100);
            $table->string('task', 500);
            $table->string('attachment', 100)->nullable();
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
        Schema::dropIfExists('daily_routines');
    }
}
