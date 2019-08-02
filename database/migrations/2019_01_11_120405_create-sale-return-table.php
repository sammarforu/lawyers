<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleReturnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('sales_returns', function(Blueprint $table)
        {
            $table->increments('id');
            $table->date('date');
            $table->string('invoice_no', 100);
            $table->string('localExport', 100);
            $table->string('biller', 100);
            $table->string('sale_type', 20);
            $table->string('sale_list', 20);
            $table->string('sample_description', 500);
            $table->string('dcn_no', 20);
            $table->integer('party_id')->unsigned();
            $table->string('due_date', 20)->nullable();
            $table->string('particulars', 100)->nullable();
            $table->timestamps();
            
            $table->foreign('party_id')
                  ->references('id')
                  ->on('parties')
                  ->onDelete('cascade');
        });
        
            Schema::create('sale_return_details', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('sale_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('party_id')->unsigned();
            $table->integer('uom_id')->unsigned();
            $table->integer('discount_id')->unsigned();
            $table->string('quantity', 100);
            $table->decimal('product_cost', 20, 2);
            $table->decimal('cost_amount', 20, 2);
            $table->decimal('sale_rate', 20, 2);
            $table->decimal('sale_amount', 20, 2);
            $table->timestamps();
            
            $table->foreign('sale_id')
                  ->references('id')
                  ->on('sales')
                  ->onDelete('cascade');
                  
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');      
                  
            $table->foreign('party_id')
                  ->references('id')
                  ->on('parties')
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
