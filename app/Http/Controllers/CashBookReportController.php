<?php

namespace App\Http\Controllers;
use App\AccountHead;
use App\Party;
use App\Setting;
use App\GeneralVoucher;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class CashBookReportController extends Controller
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
    $Heads = AccountHead::OrderBy('title', 'asc')->pluck('title', 'id')->toArray();
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
    return view('cash-book-report.index', Compact('encrypted_token', 'Heads'));
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
    // $HeadID = Input::get('head_id');
    $fromDate = $request->get('from_date');
    $toDate = $request->get('to_date');
    $Payment = GeneralVoucher::join('parties', 'parties.id', '=', 'general_vouchers.account_head_id')->whereBetween('date', [$fromDate, $toDate])
    ->OrderBy('general_vouchers.id')->get();
    // $CashReceipt = CashReceipt::join('parties', 'parties.id', '=', 'cash_receipts.account_head_id')->whereBetween('date', [$fromDate, $toDate])
    // ->OrderBy('cash_receipts.id')->get();

    $company_detail = Setting::where('id', '=', 1)->get();
    //return $Payment;
    return view('cash-book-report.report', Compact('Payment', 'company_detail'));
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
