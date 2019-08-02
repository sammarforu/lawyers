<?php

use Illuminate\Database\Seeder;
use App\Vouchers;
use App\GeneralVoucher;
class VoucherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $voucher = new Vouchers();
        $voucher->account_id = '1';
        $voucher->voucher_no = '0';
        $voucher->voucher_date = '2000-01-01';
        $voucher->v_type = '0';
        $voucher->biller = '0';
        $voucher->save();

        

        $voucher = new GeneralVoucher();
        $voucher->account_head_id = '1';
        $voucher->voucher_no = '0';
        $voucher->invoice_no = '0';
        $voucher->date = '2019-07-01';
        $voucher->v_type = '0';
        $voucher->save();

        // $voucher = new Voucher();
        // $voucher->sale_id = '0';
        // $voucher->purchase_id = '0';
        // $voucher->account_head_id = '0';
        // $voucher->date = '2000-01-01';
        // $voucher->voucher_no = '0';
        // $voucher->v_type = '0';
        // $voucher->narration = '0';
        // $voucher->debit = '0';
        // $voucher->credit = '0';
        // $voucher->save();
    }
}
