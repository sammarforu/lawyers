<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseDetail;
use App\Expense;
use DB;
class ProfitLossController extends Controller
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
    $purchases = DB::table('purchase_details')->Sum('total_cost');
    $sales = DB::table('sale_details')->Sum('sale_amount');
    $salesTax = DB::table('sale_tax_details')->Sum('total');
    $expenses = DB::table('expenses')->Sum('expense');
    $expense = Expense::join('expense_heads', 'expense_heads.id', '=', 'expenses.expensehead_id')->groupBy('expensehead_id')
   ->selectRaw('sum(expense) as sum, expense_heads.name')
   ->get();
    //$all = $expense->expense;
    //return $expenses;
    return view('profitloss.index', Compact('purchases', 'sales', 'salesTax', 'expenses', 'expense'));
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
