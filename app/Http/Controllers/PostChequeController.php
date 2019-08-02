<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GeneralVoucher;
use App\Party;
use App\Banks;
use App\PostDateCheque;
use App\PostDated;
use App\Vouchers;
use DB;
use Illuminate\Support\Facades\Input;
class PostChequeController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    $debitAccount = Party::select(DB::raw('CONCAT(`id`, "_", `party_name`) AS `id`, `party_name`'))->where('id', '=', 5)->OrderBy('party_name', 'asc')->pluck('party_name', 'id')->toArray();

    $Accounts = Party::select(DB::raw('CONCAT(`id`, "_", `party_name`) AS `id`, `party_name`'))->OrderBy('party_name', 'asc')->pluck('party_name', 'id')->toArray();
    $banks = Banks::select(DB::raw('CONCAT(`id`, "_", `name`) AS `id`, `name`'))->OrderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
    return view('post-cheque-receipt.create', Compact('encrypted_token', 'debitAccount', 'Accounts', 'banks', 'codes'));
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
    $voucherData = PostDated::create($voucher);
    $products = Input::get('product_data');
        foreach($products as $product)
        {
            $purchaseDetail = new PostDateCheque();
            $purchaseDetail->voucher_id = $voucherData['id'];
            $purchaseDetail->account_head_id = $product['head_id'];
            $purchaseDetail->date = $product['date'];
            $purchaseDetail->voucher_no = $product['voucher_no'];
            $purchaseDetail->cheque_no = $product['cheque_no'];
            $purchaseDetail->v_type = $product['v_type'];
            $purchaseDetail->status = $product['status'];
            $purchaseDetail->narration = $product['narration'];
            $purchaseDetail->bank_id = $product['bank_id'];
            // $purchaseDetail->debit = $product['debit'];
            $purchaseDetail->credit = $product['credit'];       
            $purchaseDetail->save();

        }
        //return $purchaseData['id'];
        return "saved";
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
