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
        $product->uom = 'KG';
        $product->type = '1';
        $product->product_cost = '300';
        $product->product_price = '500';
        $product->year = '2018';
        $product->tax = '17.00';
        $product->alert = '10';
        $product->pack_type = 'BAG';
        $product->pack_weight = '50';
        $product->save();

        $product = new Product();
        $product->catagory_id = '1';
        $product->publisher_id = '1';
        $product->product_code = '002';
     $product->product_name = 'Caustic Soda';
        $product->product_english = 'Caustic Soda';
        $product->uom = 'KG';
        $product->type = '1';
        $product->product_cost = '300';
        $product->product_price = '500';
        $product->year = '2018';
        $product->tax = '17.00';
        $product->alert = '10';
        $product->pack_type = 'BAG';
        $product->pack_weight = '25';
        $product->save();
    }
}
