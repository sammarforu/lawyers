<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseHead;
use Session;
class ExpenseHeadController extends Controller
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
    $heads = ExpenseHead::OrderBy('name', 'asc')->get();
    //return $heads;
    return view('expenses.heads.index', Compact('heads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('expenses.heads.create');
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
        'name' => 'required',
        'description' => 'required'
        ]);
        ExpenseHead::create($request->all());
        Session::flash('flash_message', 'Expense Head created Successfully!');
        return redirect ("expenses/heads/create");
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
    $edit = ExpenseHead::findOrFail($id);
    return view('expenses.heads.edit', Compact('edit'));
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
    $update = ExpenseHead::findOrFail($id);
    $update->update($request->all());
    Session::flash('flash_message', 'Expense Head Update Successfully!');
    return redirect ("expenses/heads"); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return "hello";
    $update = ExpenseHead::findOrFail($id);
    $update->delete();
    return "Record Deleted Successfully";
    }
}
