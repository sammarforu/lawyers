<?php

use Illuminate\Database\Seeder;
use App\Catagory;
class CatagoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $catagory = new Catagory();
       $catagory->catagory_code	 = '001';
       $catagory->catagory_name = 'Test Catagory';
       $catagory->save();
    }
}
