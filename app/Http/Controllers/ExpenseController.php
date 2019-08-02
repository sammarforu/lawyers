<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\Setting;
use App\ExpenseHead;
use Session;
use PDF;
use Excel;
class ExpenseController extends Controller
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
        $expenses = Expense::join('expense_heads', 'expense_heads.id', '=', 'expenses.id')->OrderBy('id', 'des')->get(['expenses.*', 'expense_heads.name']);
		return view('expenses/index', Compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expenseHeads = ExpenseHead::OrderBy('name', 'asc')->pluck('name', 'id');
        //return $expenseHeads;
        return view('expenses/create', Compact('expenseHeads'));
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
        'date' => 'required',
		'expensehead_id' => 'required',
		'expense' => 'required|integer'
		]);
		Expense::create($request->all());
		Session::flash('flash_message', 'Expense added Successfully!');
		return redirect('expenses/create');
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
        $edit = Expense::findOrFail($id);
        $expenseHeads = ExpenseHead::OrderBy('name', 'asc')->pluck('name', 'id');
		return view('expenses.edit', Compact('edit', 'expenseHeads'));
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
        $this->validate($request, [
		'expense' => 'required|integer',
		'description' => 'required'
		]);
		$update = Expense::findOrFail($id);
		$update->update($request->all());
		Session::flash('flash_message', 'Expense Updated Successfully!');
		return redirect('expenses');
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

    public function print_expense()
    {
    $expenses = Expense::OrderBy('date', 'asc')->get();
        //return $products; 
        $company_detail = Setting::where('id', '=', 1)->get();
        return view('expenses.print', Compact('expenses', 'company_detail'));
    }
    
    public function getPDF()
    {
    //$products = Product::with(['publisher_detail'])->with(['products_detail'])->with('sale_detail')->OrderBy('product_name', 'asc')->get();
    $expenses = Expense::OrderBy('date', 'asc')->get();
    $company_detail = Setting::where('id', '=', 1)->get();
    $pdf = PDF::loadView('expenses.expensespdf', ['expenses' => $expenses, 'company_detail' => $company_detail]);
    return $pdf->download('expenses.pdf');
    }
    
    public function getExcel()
    {
    //$data = Product::join('publishers', 'publishers.id', '=', 'products.publisher_id')->get(['products.product_code AS Code', 'Product_english AS Book', 'author AS Author', 'publishers.name AS Publisher', 'products.year', 'products.product_price AS Price'])->toArray();
    $data = Expense::OrderBy('date', 'asc')->get(['expenses.id', 'expenses.date', 'expenses.description', 'expenses.expense'])->toArray();
        return Excel::create('expenses', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download();
    }
}
