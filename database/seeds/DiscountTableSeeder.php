<?php

use Illuminate\Database\Seeder;
use App\Discount;
class DiscountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $discount = new Discount();
        $discount->title = 'No Discount';
        $discount->discount = '0.00';
        $discount->type = 'Percentage (%)';
        $discount->save();
    }
}
