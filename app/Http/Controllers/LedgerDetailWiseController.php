<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountHead;
use App\Party;
use App\Product;
use App\SaleDetail;
use App\PurchaseDetail;
use App\GeneralVoucher;
use App\Setting;
use App\StockRegisterSpecificItem;
use App\LedgerDetailWise;
use DB;
use Illuminate\Support\Facades\Input;
class LedgerDetailWiseController extends Controller
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
    $parties = Party::OrderBy('party_name', 'asc')->pluck('party_name', 'id')->prepend('Select Account', '')->toArray();
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
    return view('ledger-detail-wise.index', Compact('encrypted_token', 'parties'));
    }

    public function report(Request $request){
    $this->validate($request, [
    'party_id' => 'required',
    'from_date' => 'required',
    'to_date' => 'required'
    ]);
    $PartyID = Input::get('party_id');
    //return $PartyID;
    $fromDate = $request->get('from_date');
    $toDate = $request->get('to_date');
    // $items = LedgerDetailWise::OrderBy('ledger_detail_wise.id', 'asc')
    //          ->join('products', 'products.id', '=', 'ledger_detail_wise.product_id')
    // ->whereBetween('date', [$fromDate, $toDate])
    // ->where('ledger_detail_wise.party_id', '=', $PartyID)
    // ->get();
    $items = LedgerDetailWise::with('products')->OrderBy('ledger_detail_wise.date', 'asc')
    ->whereBetween('date', [$fromDate, $toDate])
    ->where('ledger_detail_wise.party_id', '=', $PartyID)
    //->where('ledger_detail_wise.id', '=', '53')
    ->get();
    //return $items;
    $party = Party::where('id', '=', $PartyID)->get();
    $company_detail = Setting::where('id', '=', 1)->get();
    return view('ledger-detail-wise.report', Compact('items', 'company_detail', 'party'));
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
        //
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
