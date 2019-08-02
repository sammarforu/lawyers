<?php

use Illuminate\Database\Seeder;
use App\Banks;
class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $bank = new Banks();
       $bank->code = '001';
       $bank->name = 'MEEZAN BANK';
       $bank->save();
    }
}
