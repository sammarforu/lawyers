<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('expense_heads', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('description', 250);
            $table->timestamps();
        });
    
        Schema::create('expenses', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('date', 20);
            $table->integer('expensehead_id')->unsigned();
			$table->decimal('expense', 20, 2);
			$table->string('description', 250);
			$table->timestamps();
            $table->foreign('expensehead_id')
                  ->references('id')
                  ->on('expense_heads')
                  ->onDelete('cascade');
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
