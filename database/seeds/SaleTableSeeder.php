<?php

use Illuminate\Database\Seeder;
use App\Sales;
use App\SaleReturn;
class SaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $sales = new Sales();
      $sales->date = '2000-01-01';
      $sales->invoice_no = '0';
      $sales->localExport = '0';
      $sales->biller = '0';
      $sales->sale_type = '0';
      $sales->sale_list = '0';
      $sales->sample_description = '0';
      $sales->dcn_no = '0';
      $sales->party_id = '1';
      $sales->warehouse_id = '1';
      $sales->due_date = '2000-01-01';
      $sales->particulars = '0';
      $sales->save();

      $sales = new SaleReturn();
      $sales->date = '2000-01-01';
      $sales->invoice_no = '0';
      $sales->localExport = '0';
      $sales->biller = '0';
      $sales->sale_type = '0';
      $sales->sale_list = '0';
      $sales->sample_description = '0';
      $sales->dcn_no = '0';
      $sales->party_id = '1';
      $sales->due_date = '2000-01-01';
      $sales->particulars = '0';
      $sales->save();
    }
}
