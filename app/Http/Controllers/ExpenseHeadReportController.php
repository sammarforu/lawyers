<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\ExpenseHead;
use App\Expense;
use App\Setting;
class ExpenseHeadReportController extends Controller
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
        $ExpenseHeads = ExpenseHead::OrderBy('name', 'asc')->pluck('name', 'id')->toArray();
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
    return view('expense-head-report.create', Compact('encrypted_token', 'ExpenseHeads'));
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
    //$supplier = Input::get('supplier_name');
    $ExpenseHead_id = Input::get('expensehead_id');
    $fromDate = $request->get('from_date');
    $toDate = $request->get('to_date');
    //return $fromDate;
    $expenses = Expense::where('expensehead_id', '=', $ExpenseHead_id)->whereBetween('date', [$fromDate, $toDate])->OrderBy('id', 'asc')->get();
    //return $purchases;
    //$suppliers = Supplier::OrderBy('name', 'asc')->pluck('name', 'id')->toArray();
    $company_detail = Setting::where('id', '=', 1)->get();
    return view('expense-head-report.index', compact('expenses', 'encrypted_token', 'company_detail'));
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
