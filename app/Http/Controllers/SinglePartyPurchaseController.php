<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Supplier;
use App\Purchase;
use App\Setting;
class SinglePartyPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function create()
    {

        $suppliers = Supplier::OrderBy('name', 'asc')->pluck('name', 'id')->toArray();
        //return $suppliers;
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
        return view('single-party-purchase-report.create', Compact('encrypted_token', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $encrypter = app('Illuminate\Encryption\Encrypter');
    $encrypted_token = $encrypter->encrypt(csrf_token());
    $supplier = Input::get('supplier_name');
    $fromDate = $request->get('from_date');
    $toDate = $request->get('to_date');
    //return $supplier;
    $purchases = Purchase::with('purchase_details')->with('suppliers')->where('supplier_id', '=', $supplier)->whereBetween('date', [$fromDate, $toDate])->OrderBy('id', 'asc')->get();
    //return $purchases;
    $suppliers = Supplier::OrderBy('name', 'asc')->pluck('name', 'id')->toArray();
    $company_detail = Setting::where('id', '=', 1)->get();
    return view('single-party-purchase-report.index', compact('purchases', 'encrypted_token', 'suppliers', 'company_detail'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
    $encrypter = app('Illuminate\Encryption\Encrypter');
    $encrypted_token = $encrypter->encrypt(csrf_token());
    $supplier = Input::get('supplier_name');
    $fromDate = $request->get('from_date');
    $toDate = $request->get('to_date');
    return $fromDate;
    $purchases = Purchase::with('purchase_details')->with('suppliers')->where('supplier_id', '=', $supplier)->whereBetween('date', [$fromDate, $toDate])->OrderBy('id', 'asc')->get();
    return $purchases;
    $suppliers = Supplier::OrderBy('name', 'asc')->pluck('name', 'id')->toArray();
    return view('single-party-purchase-report.create', compact('purchases', 'encrypted_token', 'suppliers'));
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
