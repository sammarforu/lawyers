<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Party;
use App\SaleTax;
use App\Setting;
class SaleTaxReportController extends Controller
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
     $parties = Party::OrderBy('party_name', 'asc')->pluck('party_name', 'id')->toArray();
        //return $suppliers;
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
        return view('salestax-report.all-party.create', Compact('encrypted_token', 'parties'));
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
    $fromDate = $request->get('from_date');
    $toDate = $request->get('to_date');
    //return $supplier;
    $sales = SaleTax::with('saletax_details')->with('parties')->whereBetween('date', [$fromDate, $toDate])->OrderBy('id', 'asc')->get();
    //return $sales;
    //$suppliers = Supplier::OrderBy('name', 'asc')->pluck('name', 'id')->toArray();
    $company_detail = Setting::where('id', '=', 1)->get();
    return view('salestax-report.all-party.index', compact('sales', 'encrypted_token', 'suppliers', 'company_detail'));
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
