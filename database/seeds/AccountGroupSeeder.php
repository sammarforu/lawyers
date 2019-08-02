<?php

use Illuminate\Database\Seeder;
use App\AccountGroup;
class AccountGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $catagory = new AccountGroup();
       $catagory->code	 = '01';
       $catagory->name = 'CLIENT';
       $catagory->save();

       $catagory = new AccountGroup();
       $catagory->code   = '02';
       $catagory->name = 'BUYER';
       $catagory->save();

       $catagory = new AccountGroup();
       $catagory->code   = '03';
       $catagory->name = 'ASSET';
       $catagory->save();

       $catagory = new AccountGroup();
       $catagory->code   = '04';
       $catagory->name = 'LIABILITY';
       $catagory->save();

       $catagory = new AccountGroup();
       $catagory->code   = '05';
       $catagory->name = 'BANK';
       $catagory->save();

       $catagory = new AccountGroup();
       $catagory->code   = '06';
       $catagory->name = 'EXPENSES';
       $catagory->save();

       $catagory = new AccountGroup();
       $catagory->code   = '08';
       $catagory->name = 'CLIENT & SUPPLIER BOTH';
       $catagory->save();
    }
}
