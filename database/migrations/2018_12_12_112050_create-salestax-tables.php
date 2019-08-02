<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalestaxTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('sale_taxes', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('party_id')->unsigned();
            $table->date('date');
            $table->string('sale_type', 20);
            $table->string('invoice_no', 100);
            $table->string('dcn_no', 100)->nullable();
            $table->string('p_order', 30)->nullable();
            $table->string('remarks', 500)->nullable();
            $table->string('biller', 100);
            $table->timestamps();
            
            $table->foreign('party_id')
                  ->references('id')
                  ->on('parties')
                  ->onDelete('cascade');
        });
        
            Schema::create('sale_tax_details', function(Blueprint $table)
        {

            $table->increments('id');
            $table->integer('sale_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('party_id')->unsigned();
            $table->integer('uom_id')->unsigned();
            $table->string('status', 20);
            $table->string('quantity', 100);
            $table->decimal('rate', 20, 2);
            $table->string('stvalue', 100);
            $table->string('taxvalue', 100);
            $table->string('extratax', 100);
            $table->string('extraTaxValue', 100);
            $table->decimal('price', 20, 2);
            $table->decimal('total', 20, 2);
            $table->timestamps();

            $table->foreign('sale_id')->references('id')->on('sales')
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
