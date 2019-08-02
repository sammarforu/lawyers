<?php

use Illuminate\Database\Seeder;
use App\GRN;
class GRNTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $grns = new GRN();
      $grns->account_id = '1';
      $grns->date = '2000-01-01';
      $grns->grn_no = '0';
      $grns->status = '0';
      $grns->save();
    }
}
