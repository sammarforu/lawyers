<?php

use Illuminate\Database\Seeder;
use App\SaleTax;
use App\PurchaseTax;
class SaleTaxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $salestax = new SaleTax();
      $salestax->party_id = '1';
      $salestax->date = '2000-01-01';
      $salestax->sale_type = '0';
      $salestax->invoice_no = '0';
      $salestax->dcn_no = '0';
      $salestax->p_order = '0';
      $salestax->biller = '0';
      $salestax->save();

      $salestax = new PurchaseTax();
      $salestax->party_id = '1';
      $salestax->voucher_no = '0';
      $salestax->invoice_no = '0';
      $salestax->date = '2000-01-01';
      $salestax->purchase_type = '0';
      $salestax->remarks = '0';
      $salestax->biller = '0';
      $salestax->save();
    }
}
