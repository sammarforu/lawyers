<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use Session;
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
        $expenses = Expense::OrderBy('id', 'des')->get();
		return view('expenses/index', Compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expenses/create');
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
		'date' => 'date',
		'expense' => 'required',
		'description' => 'required'
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
		return view('expenses.edit', Compact('edit'));
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
		'date' => 'date',
		'expense' => 'required',
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
}
