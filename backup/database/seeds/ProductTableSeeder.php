<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $product = new Product();
       $product->catagory_id = '1';
       $product->publisher_id = '1';
       $product->product_code = '001';
       $product->product_name = 'Test';
       $product->product_english = 'Test';
       $product->author = 'Test Name';
       $product->product_cost = '300';
       $product->product_price = '500';
       $product->year = '2018';
       $product->save();
    }
}
