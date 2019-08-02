<?php

use Illuminate\Database\Seeder;
use App\LCIndentor;
use App\LCAccount;
use App\LCLocation;
class LCSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $indentor = new LCIndentor();
       $indentor->indentor_name = 'TEST INDENTOR';
       $indentor->save();

       $indentor = new LCAccount();
       $indentor->account_name = 'TEST ACCOUNT';
       $indentor->save();

       $indentor = new LCLocation();
       $indentor->location_name = 'TEST LOCATION';
       $indentor->save();
    }
}
