<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountHead;
use App\Party;
use App\BankPayment;
use App\GeneralVoucher;
use App\Setting;
use App\LedgerDetailWise;
use DB;
use Illuminate\Support\Facades\Input;
class ClientAllReportController extends Controller
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
    $Heads = Party::OrderBy('party_name', 'asc')->pluck('party_name', 'id')->prepend('Select Account', '')->toArray();
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
    return view('client-all-report.index', Compact('encrypted_token', 'Heads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
    }

    public function report(Request $request){
        $this->validate($request, [
        'head_id' => 'required',
        'from_date' => 'required',
        'to_date' => 'required'
        ]);
    $HeadID = Input::get('head_id');
    //return $HeadID;
    $fromDate = $request->get('from_date');
    $toDate = $request->get('to_date');
    $ReportDetail = $request->get('ReportDetail');
    //return $ReportDetail;
    //return $ReportDetail;
     // $GeneralVoucher = GeneralVoucher::join('parties', 'parties.id', '=', 'general_vouchers.account_head_id')
     // ->where('general_vouchers.account_head_id', '=', $HeadID)
     // ->whereBetween('general_vouchers.date', [$fromDate, $toDate])
     // ->OrderBy('general_vouchers.id')->get();
    

    // if($ReportDetail==2)
    // {
    //     return "this is two";
    // }
    //Summary
    $GeneralVoucher = GeneralVoucher::with('banks')->orderBy('date', 'asc')
        ->whereBetween('general_vouchers.date', [$fromDate, $toDate])
        ->where('account_head_id', '=', $HeadID)->get();
    //Detail
    $items = LedgerDetailWise::with('products')->OrderBy('ledger_detail_wise.date', 'asc')
    ->whereBetween('date', [$fromDate, $toDate])
    ->where('ledger_detail_wise.party_id', '=', $HeadID)
    //->where('ledger_detail_wise.id', '=', '53')
    ->get();

    $party = Party::where('id', '=', $HeadID)->get();
    //return $party;
    $company_detail = Setting::where('id', '=', 1)->get();
    if($ReportDetail=="1")
    {
        //return "one";
        return view('client-all-report.report', Compact('GeneralVoucher', 'company_detail', 'party'));
    }

    if($ReportDetail=="2")
    {
        //return "two";
        return view('ledger-detail-wise.report', Compact('items', 'company_detail', 'party'));
    }
    
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
