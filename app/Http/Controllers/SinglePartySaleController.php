<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Party;
use App\Sales;
use App\Setting;
class SinglePartySaleController extends Controller
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
       $parties = Party:://where('type', '=', 'Client')
                        OrderBy('party_name', 'asc')->pluck('party_name', 'id')->toArray();
        //return $suppliers;
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
        return view('sales-report.single-party.create', Compact('encrypted_token', 'parties')); 
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
    $party = Input::get('party_name');
    $fromDate = $request->get('from_date');
    $toDate = $request->get('to_date');
    //return $supplier;
    $sales = Sales::with('sale_details')->with('parties')->where('party_id', '=', $party)->whereBetween('date', [$fromDate, $toDate])->OrderBy('id', 'asc')->get();
    //return $sales;
    //$suppliers = Supplier::OrderBy('name', 'asc')->pluck('name', 'id')->toArray();
    $party = Party::where('id', '=', $party)->get();
    //return $party;
    $company_detail = Setting::where('id', '=', 1)->get();
    return view('sales-report.single-party.index', compact('sales', 'encrypted_token', 'party', 'company_detail'));
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
