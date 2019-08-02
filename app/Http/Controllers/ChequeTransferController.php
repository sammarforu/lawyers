<?php

namespace App\Http\Controllers;
use App\PostDateCheque;
use App\Vouchers;
use App\Party;
use App\PostDated;
use App\GeneralVoucher;
use App\LedgerDetailWise;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class ChequeTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $cheques = PostDateCheque::OrderBy('id')->get();
    $encrypter = app('Illuminate\Encryption\Encrypter');
    $encrypted_token = $encrypter->encrypt(csrf_token());
    return view('cheque-transfer.index', Compact('cheques', 'encrypted_token'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    $code = Vouchers::OrderBy('id', 'asc')->get();
    $codes = $code->last()->voucher_no + 1;
    $Heads = Party::select(DB::raw('CONCAT(`id`, "_", `party_name`) AS `id`, `party_name`'))->OrderBy('party_name', 'asc')->pluck('party_name', 'id')->toArray();
    $encrypter = app('Illuminate\Encryption\Encrypter');
    // $cheques = PostDated::with(['cheque_details'=> function($query){
    //     $query->with('party');
    //     $query->with('banks');
    // }])->get();
    $cheques = PostDateCheque::with('post_dated')->get();
    //return $cheques;
    $encrypted_token = $encrypter->encrypt(csrf_token());
    return view('cheque-transfer.create', Compact('encrypted_token', 'codes', 'Heads', 'cheques'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $voucher = json_decode(Input::get('voucher'), true);
    //return $voucher;
    $voucherData = Vouchers::create($voucher);
    $products = Input::get('product_data');

    // if($voucherData->voucher_no !="0"){
    //     $project = PostDateCheque::where("voucher_no", $voucherData->voucher_no)->first();
    //     $project->status = "Clear";
    //     $project->save();
    // }
    //return $products;
        foreach($products as $product)
        {
            if(($product['checkedValue']) == "true"){
                //return "entered";
            $purchaseDetail = new GeneralVoucher();
            $purchaseDetail->voucher_id = $voucherData['voucher_id'];
            $purchaseDetail->account_head_id = $voucherData['account_from_id'];
            $purchaseDetail->bank_id = $product['bank_id'];
            $purchaseDetail->date = $voucherData['voucher_date'];
            $purchaseDetail->voucher_no = $product['voucher_no'];
            $purchaseDetail->cheque_no = $product['cheque_no'];
            $purchaseDetail->v_type = $product['v_type'];
            $purchaseDetail->narration = $product['narration'];
            $purchaseDetail->credit = $product['amount'];       
            $purchaseDetail->save();

            $purchaseDetail = new GeneralVoucher();
            $purchaseDetail->voucher_id = $voucherData['voucher_id'];
            $purchaseDetail->account_head_id = $voucherData['account_id'];
            $purchaseDetail->bank_id = $product['bank_id'];
            $purchaseDetail->date = $voucherData['voucher_date'];
            $purchaseDetail->voucher_no = $product['voucher_no'];
            $purchaseDetail->cheque_no = $product['cheque_no'];
            $purchaseDetail->v_type = $product['v_type'];
            $purchaseDetail->narration = $product['narration'];
            $purchaseDetail->debit = $product['amount'];       
            $purchaseDetail->save();

            $vouchers = new LedgerDetailWise();
            $vouchers->voucher_id = $voucherData['id'];
            $vouchers->party_id = $voucherData['account_from_id'];
            $vouchers->voucher_no = $product['voucher_no'];
            $vouchers->voucher_type = $product['v_type'];
            $vouchers->date = $voucherData['voucher_date'];
            $vouchers->other = $product['narration'];
            $vouchers->credit = $product['amount'];
            $vouchers->save();

            $vouchers = new LedgerDetailWise();
            $vouchers->voucher_id = $voucherData['id'];
            $vouchers->party_id = $voucherData['account_id'];
            $vouchers->voucher_no = $product['voucher_no'];
            $vouchers->voucher_type = $product['v_type'];
            $vouchers->date = $voucherData['voucher_date'];
            $vouchers->other = $product['narration'];
            $vouchers->debit = $product['amount'];
            $vouchers->save();

            if($voucherData->voucher_no !="0"){
            $project = PostDateCheque::where("id", $product['VoucherID'])->first();
            $project->status = "Clear";
            $project->save();
            }

            return $voucherData['id'];
         }
         // else{
         //   echo "<alert>Select Cheque First!</alert>";
         // }

         // if(($product['checkedValue']) == false){
         //        return "not entered";
         //    }

        }
        //return $purchaseData['id'];
        //return $voucherData['id'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
