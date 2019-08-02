<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\SupplierLedgers;
use App\Setting;
use Session;
class SupplierLedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $suppliers = Supplier::OrderBy('name', 'asc')->get();
    return view('ledger.suppliers.index', Compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    $suppliers = Supplier::OrderBy('name', 'asc')->pluck('name', 'id');
    return view('ledger.suppliers.create', Compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'supplier_id' => 'required',
        'date' => 'required',
        'particulars' => 'required'
        ]);
    SupplierLedgers::create($request->all());
    Session::flash('flash_message', 'Ledger Updated Successfully!');
    return redirect('ledger/suppliers/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    $ledgers = SupplierLedgers::join('suppliers', 'suppliers.id',  'supplier_ledgers.supplier_id')
                          ->where('supplier_id', '=', $id)->OrderBy('id', 'asc')->get(['supplier_ledgers.*', 'suppliers.name', 'suppliers.phone', 'suppliers.city']);
    $party = Supplier::OrderBy('name', 'asc')->where('id', '=', $id)->get();
    $company_detail = Setting::OrderBy('id', 'asc')->where('id', '=', 1)->get();
    return view('ledger.suppliers.details', Compact('ledgers', 'company_detail', 'party', 'id'));
    }

    public function printledger($id)
    {
    $ledgers = SupplierLedgers::join('suppliers', 'suppliers.id',  'supplier_ledgers.supplier_id')
                          ->where('supplier_id', '=', $id)->OrderBy('id', 'asc')->get(['supplier_ledgers.*', 'suppliers.name', 'suppliers.phone', 'suppliers.city']);
    $party = Supplier::OrderBy('name', 'asc')->where('id', '=', $id)->get();
    $company_detail = Setting::OrderBy('id', 'asc')->where('id', '=', 1)->get();
    return view('ledger.suppliers.print', Compact('ledgers', 'company_detail', 'party', 'id'));
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
