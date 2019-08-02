<?php

use Illuminate\Database\Seeder;
use App\Party;
class PartyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $party = new Party();
       $party->party_name = 'Cash Customer';
       $party->phone = '03XXXXXXXXX';
       $party->ntn = '9876543-2';
       $party->strn = '1234567-8';
       $party->city = 'Lahore';
       $party->address = 'Walking Costomer';
       $party->type = 'WholeSaler';
       $party->save();
    }
}
