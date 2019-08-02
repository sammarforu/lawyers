<?php

use Illuminate\Database\Seeder;
use App\Warehouse;
class WarehouseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $wareHouse = new Warehouse();
       $wareHouse->code = '01';
       $wareHouse->name = 'SHOP STEEL MARKET';
       $wareHouse->phone = '03XXXXXXXXX';
       $wareHouse->email = 'warehouse1@gmail.com';
       $wareHouse->address = 'Lahore, Punjab, Pakistan.';
       $wareHouse->save();

       $wareHouse = new Warehouse();
       $wareHouse->code = '01';
       $wareHouse->name = 'SHOP HADEED BAZAAR';
       $wareHouse->phone = '03XXXXXXXXX';
       $wareHouse->email = 'warehouse1@gmail.com';
       $wareHouse->address = 'Lahore, Punjab, Pakistan.';
       $wareHouse->save();

       $wareHouse = new Warehouse();
       $wareHouse->code = '01';
       $wareHouse->name = 'WAREHOUSE STEEL MARKET';
       $wareHouse->phone = '03XXXXXXXXX';
       $wareHouse->email = 'warehouse1@gmail.com';
       $wareHouse->address = 'Lahore, Punjab, Pakistan.';
       $wareHouse->save();
    }  //

}
