<?php

namespace App\Http\Controllers;
use App\AccountHead;
use App\Party;
use App\CashPayment;
use App\Setting;
use App\GeneralVoucher;
use App\LedgerDetailWise;
use App\Vouchers;
use App\SystemLogo;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class CashPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
    $this->middleware('auth');
    }
    
    public function index()
    {
    $Heads = Party::OrderBy('party_name', 'asc')->pluck('party_name', 'id')->toArray();
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
        $Vouchers = Vouchers::with(['voucher_details'=>function($query){
        //$query->with('products');
        //$query->with('uoms');
        //$query->with('discount');
        }])->with('parties')->where('vouchers.v_type', 'Cash Payment')->get();
        //return $Vouchers;
    return view('cash-payments.index', Compact('encrypted_token', 'Vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    $code = GeneralVoucher::OrderBy('id', 'asc')->get();
    $codes = $code->last()->voucher_no + 1;
    $cashAccount = Party::select(DB::raw('CONCAT(`id`, "_", `party_name`) AS `id`, `party_name`'))->where('id', '=', 4)->OrderBy('party_name', 'asc')->pluck('party_name', 'id')->prepend('CASH IN HAND', '4_CASH IN HAND')->toArray();
    $Accounts = Party::select(DB::raw('CONCAT(`id`, "_", `party_name`) AS `id`, `party_name`'))->OrderBy('party_name', 'asc')->pluck('party_name', 'id')->toArray();
    $encrypter = app('Illuminate\Encryption\Encrypter');
    $encrypted_token = $encrypter->encrypt(csrf_token());
    return view('cash-payments.create', Compact('encrypted_token', 'cashAccount', 'Accounts', 'codes'));
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
            // Top account | Credit account | Payment account
            $purchaseDetail = new GeneralVoucher();
            $purchaseDetail->voucher_id = $voucherData['id'];
            $purchaseDetail->account_head_id = $voucherData['account_id'];
            $purchaseDetail->date = $product['date'];
            $purchaseDetail->voucher_no = $product['voucher_no'];
            $purchaseDetail->v_type = $product['v_type'];
            $purchaseDetail->narration = $product['narration'];
            $purchaseDetail->credit = $product['amount'];       
            $purchaseDetail->save();
            // Below account | Debit account | Receive account
            $purchaseDetail = new GeneralVoucher();
            $purchaseDetail->voucher_id = $voucherData['id'];
            $purchaseDetail->account_head_id = $product['head_id'];
            $purchaseDetail->date = $product['date'];
            $purchaseDetail->voucher_no = $product['voucher_no'];
            $purchaseDetail->v_type = $product['v_type'];
            $purchaseDetail->narration = $product['narration'];
            $purchaseDetail->debit = $product['amount'];       
            $purchaseDetail->save();
            /// Top account | Credit account | Payment account
             $vouchers = new LedgerDetailWise();
             $vouchers->voucher_id = $purchaseDetail['id'];
             $vouchers->party_id = $voucherData['account_id'];
             $vouchers->voucher_no = $product['voucher_no'];
             $vouchers->voucher_type = $product['v_type'];
             $vouchers->date = $product['date'];
             $vouchers->other = $product['narration'];
             $vouchers->credit = $product['amount'];
             $vouchers->save();
              // Below account | Debit account | Receive account
             $vouchers = new LedgerDetailWise();
             $vouchers->voucher_id = $purchaseDetail['id'];
             $vouchers->party_id = $product['head_id'];
             $vouchers->voucher_no = $product['voucher_no'];
             $vouchers->voucher_type = $product['v_type'];
             $vouchers->date = $product['date'];
             $vouchers->other = $product['narration'];
             $vouchers->debit = $product['amount'];
             $vouchers->save();

        }
        //return $purchaseData['id'];
        return "saved";
    }

    public function report(Request $request){
    $HeadID = Input::get('head_id');
    $fromDate = $request->get('from_date');
    $toDate = $request->get('to_date');
    $GeneralVoucher = CashPayment::join('parties', 'parties.id', '=', 'cash_payments.account_head_id')->where('cash_payments.account_head_id', '=', $HeadID)
    ->whereBetween('date', [$fromDate, $toDate])
    ->OrderBy('cash_payments.id')->get();

    $company_detail = Setting::where('id', '=', 1)->get();
    //return $CashReceipts;
    return view('cash-payments.report', Compact('GeneralVoucher', 'company_detail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $newsale_detail = Vouchers::with(['voucher_details'=>function($query){
        //$query->with('products');
        //$query->with('uoms');
        $query->with('parties');
        }])->with('parties')->where('vouchers.id', '=', $id)
       // ->orwhere('voucher_details.credit', '!=', null)
        ->get();
        $company_detail = Setting::where('id', '=', 1)->get();
        $logo = SystemLogo::where('id', '=', 1)->get();
        //return $newsale_detail;
        return view('cash-payments.print', Compact('newsale_detail', 'company_detail', 'logo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $purchase = Vouchers::with(['voucher_details'=>function($query){
        //$query->with('products');
        //$query->with('uoms');
        $query->with('parties');
        }])->with('parties')->where('vouchers.id', '=', $id)
       // ->orwhere('voucher_details.credit', '!=', null)
        ->get();
        $edit = $purchase[0];
        //$company_detail = Setting::where('id', '=', 1)->get();
        //$logo = SystemLogo::where('id', '=', 1)->get();
        //return $edit;
        $code = Vouchers::OrderBy('id', 'asc')->get();
    //return $code;
   $codes = $code->last()->voucher_no + 1;
    $cashAccount = Party::select(DB::raw('CONCAT(`id`, "_", `party_name`) AS `id`, `party_name`'))->where('id', '=', 4)->OrderBy('party_name', 'asc')->pluck('party_name', 'id')->prepend('CASH IN HAND', '4_CASH IN HAND')->toArray();

    $Accounts = Party::select(DB::raw('CONCAT(`id`, "_", `party_name`) AS `id`, `party_name`'))->OrderBy('party_name', 'asc')->pluck('party_name', 'id')->toArray();
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
        return view('cash-payments.edit', Compact('edit', 'codes', 'cashAccount', 'Accounts', 'encrypted_token'));
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
          $voucherData = Vouchers::findOrFail($id);
        $voucher = json_decode(Input::get('voucher'), true);
        $voucherData->account_id = $voucher['account_id'];
        $voucherData->voucher_date = date('Y-m-d',strtotime($voucher['voucher_date']));
        $voucherData->voucher_no = $voucher['voucher_no'];
        $voucherData->save();
        GeneralVoucher::where('voucher_id', '=', $id)->delete();
        LedgerDetailWise::where('voucher_id', '=', $id)->delete();
        $products = Input::get('product_data'); 
        //return $products;
        $sum = "0"; 
        foreach($products as $product)
        {
           $purchaseDetail = new GeneralVoucher();
            $purchaseDetail->voucher_id = $voucherData['id'];
            $purchaseDetail->account_head_id = $voucherData['account_id'];
            $purchaseDetail->date = $product['date'];
            $purchaseDetail->voucher_no = $product['voucher_no'];
            $purchaseDetail->v_type = $product['v_type'];
            $purchaseDetail->narration = $product['narration'];
            $purchaseDetail->credit = $product['amount'];       
            $purchaseDetail->save();
            // Below account | Debit account | Receive account
            $purchaseDetail = new GeneralVoucher();
            $purchaseDetail->voucher_id = $voucherData['id'];
            $purchaseDetail->account_head_id = $product['head_id'];
            $purchaseDetail->date = $product['date'];
            $purchaseDetail->voucher_no = $product['voucher_no'];
            $purchaseDetail->v_type = $product['v_type'];
            $purchaseDetail->narration = $product['narration'];
            $purchaseDetail->debit = $product['amount'];       
            $purchaseDetail->save();
            /// Top account | Credit account | Payment account
             $vouchers = new LedgerDetailWise();
             $vouchers->voucher_id = $purchaseDetail['id'];
             $vouchers->party_id = $voucherData['account_id'];
             $vouchers->voucher_no = $product['voucher_no'];
             $vouchers->voucher_type = $product['v_type'];
             $vouchers->date = $product['date'];
             $vouchers->other = $product['narration'];
             $vouchers->credit = $product['amount'];
             $vouchers->save();
              // Below account | Debit account | Receive account
             $vouchers = new LedgerDetailWise();
             $vouchers->voucher_id = $purchaseDetail['id'];
             $vouchers->party_id = $product['head_id'];
             $vouchers->voucher_no = $product['voucher_no'];
             $vouchers->voucher_type = $product['v_type'];
             $vouchers->date = $product['date'];
             $vouchers->other = $product['narration'];
             $vouchers->debit = $product['amount'];
             $vouchers->save();
        }
        return $voucherData['id'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $delete = Vouchers::findOrFail($id);
        $delete->delete();
        GeneralVoucher::where('voucher_id', '=', $id)->delete(); 
        LedgerDetailWise::where('voucher_id', '=', $id)->delete();
        // Ledger::where('sale_id', '=', $id)->delete();       
        return "Cash Payment has been Deleted Successfully!";
    }
}
