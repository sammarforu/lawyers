<?php

use Illuminate\Database\Seeder;
use App\Tax;
class TaxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tax = new Tax();
        $tax->tax_title = 'No Tax';
        $tax->tax_rate = '0.00';
        $tax->tax_type = 'Percentage (%)';
        $tax->save();
    }
}
