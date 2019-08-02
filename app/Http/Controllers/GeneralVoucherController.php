<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\AccountHead;
use App\Party;
use App\GeneralVoucher;
use App\Setting;
use App\LedgerDetailWise;
use App\Vouchers;
use Session;
use DB;
class GeneralVoucherController extends Controller
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
     //$Heads = AccountHead::select(DB::raw('CONCAT(`id`, "_", `title`) AS `id`, `title`'))->OrderBy('title', 'asc')->pluck('title', 'id')->toArray();
     // $Heads = AccountHead::OrderBy('title', 'asc')->pluck('title', 'id')->toArray();
        $Heads = Party::OrderBy('party_name', 'asc')->pluck('party_name', 'id')->toArray();
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
    return view('general-voucher.index', Compact('encrypted_token', 'Heads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$Heads = AccountHead::OrderBy('title', 'asc')->pluck('title', 'id')->prepend('Select Account Head', '0')->toArray();
        // $Heads = AccountHead::select(DB::raw('CONCAT(`id`, "_", `title`) AS `id`, `title`'))->OrderBy('title', 'asc')->pluck('title', 'id')->toArray();
        $code = GeneralVoucher::OrderBy('id', 'asc')->get();
       $codes = $code->last()->voucher_no + 1;

        $Heads = Party::select(DB::raw('CONCAT(`id`, "_", `party_name`) AS `id`, `party_name`'))->OrderBy('party_name', 'asc')->pluck('party_name', 'id')->toArray();
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
    return view('general-voucher.create', Compact('encrypted_token', 'Heads', 'codes'));
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
    //$voucher['date'] = date('Y-m-d',strtotime($voucher['date'])); 
    $voucherData = Vouchers::create($voucher);
    $products = Input::get('product_data');
        foreach($products as $product)
        {
            $purchaseDetail = new GeneralVoucher();
            $purchaseDetail->voucher_id = $voucherData['id'];
            $purchaseDetail->account_head_id = $product['head_id'];
            $purchaseDetail->date = $product['date'];
            $purchaseDetail->voucher_no = $product['voucher_no'];
            $purchaseDetail->v_type = $product['v_type'];
            $purchaseDetail->narration = $product['narration'];
            $purchaseDetail->debit = $product['debit'];
            $purchaseDetail->credit = $product['credit'];       
            $purchaseDetail->save();

            $vouchers = new LedgerDetailWise();
             $vouchers->voucher_id = $purchaseDetail['id'];
             $vouchers->party_id = $product['head_id'];
             $vouchers->voucher_no = $product['voucher_no'];
             $vouchers->voucher_type = $product['v_type'];
             $vouchers->date = $product['date'];
             $vouchers->other = $product['narration'];
             $vouchers->debit = $product['debit'];
             $vouchers->credit = $product['credit'];
             $vouchers->save();
        }
        //return $purchaseData['id'];
        return "saved";
    }

    public function report(Request $request){
    $LedgerID = Input::get('ledger_id');
    $fromDate = $request->get('from_date');
    $toDate = $request->get('to_date');
    $GeneralVoucher = GeneralVoucher::join('parties', 'parties.id', '=', 'general_vouchers.account_head_id')->where('general_vouchers.account_head_id', '=', $LedgerID)
    ->whereBetween('date', [$fromDate, $toDate])
    ->where('general_vouchers.v_type', '=', 'General Voucher')
    ->OrderBy('general_vouchers.id')->get();
    //return $GeneralVoucher;
    $company_detail = Setting::where('id', '=', 1)->get();
    //return $GeneralVoucher;
    return view('general-voucher.report', Compact('GeneralVoucher', 'company_detail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
