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
       $party->account_group_id = 1;
       $party->account_type = 'Client';
       $party->party_name = 'Cash Customer';
       $party->phone = '03XXXXXXXXX';
       $party->ntn = '9876543-2';
       $party->strn = '1234567-8';
       $party->city = 'Lahore';
       $party->address = 'Walking Costomer';
       $party->save();

       $party = new Party();
       $party->account_group_id = 1;
       $party->account_type = 'Client';
       $party->party_name = 'Nevtech';
       $party->phone = '0321 9090809';
       $party->ntn = '9876543-3';
       $party->strn = '1234567-9';
       $party->city = 'Lahore';
       $party->address = 'Ruhi Naala, Lahore.';
       $party->save();

       $party = new Party();
       $party->account_group_id = 2;
       $party->account_type = 'Buyer';
       $party->party_name = 'Ittehad';
       $party->phone = '0321 8080808';
       $party->ntn = '9876543-4';
       $party->strn = '1234567-0';
       $party->city = 'Lahore';
       $party->address = 'Kala Shah Kaku, Lahore.';
       $party->save();

       $party = new Party();
       $party->account_group_id = 3;
       $party->account_type = 'ASSET';
       $party->party_name = 'CASH IN HAND';
       $party->phone = '';
       $party->ntn = '';
       $party->strn = '';
       $party->city = '';
       $party->address = '';
       $party->save();

       $party = new Party();
       $party->account_group_id = 3;
       $party->account_type = 'ASSET';
       $party->party_name = 'CHEQUE IN HAND';
       $party->phone = '';
       $party->ntn = '';
       $party->strn = '';
       $party->city = '';
       $party->address = '';
       $party->save();

       $party = new Party();
       $party->account_group_id = 5;
       $party->account_type = 'BANK';
       $party->party_name = 'MEEZAN BANK';
       $party->phone = '';
       $party->ntn = '';
       $party->strn = '';
       $party->city = '';
       $party->address = '';
       $party->save();

       $party = new Party();
       $party->account_group_id = 5;
       $party->account_type = 'BANK';
       $party->party_name = 'ALFALAH BANK';
       $party->phone = '';
       $party->ntn = '';
       $party->strn = '';
       $party->city = '';
       $party->address = '';
       $party->save();
    }
}
