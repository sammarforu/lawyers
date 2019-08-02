<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tax;
use Session;
class TaxController extends Controller
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
		$taxes = Tax::OrderBy('id', 'asc')->get();
        return view('taxes.index', Compact('taxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('taxes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate ($request, [
		'tax_title' => 'required',
		'tax_rate' => 'required',
		'tax_type' => 'required'
		]);
        Tax::create($request->all());
		Session::flash('flash_message', 'Tax Rate Added Successfully!');
		return redirect('taxes');
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
        $edit = Tax::findOrFail($id);
		return view('taxes.edit', Compact('edit'));
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
        $this->validate ($request, [
		'tax_title' => 'required',
		'tax_rate' => 'required',
		'tax_type' => 'required'
		]);
		$update = Tax::findOrFail($id);
		$update->update($request->all());
		Session::flash('flash_message', 'Tax Rate Updated Successfully!');
		return redirect('taxes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Tax::findOrFail($id);
		$delete->delete();
		return "Tax Rate Deleted Successfully!";
    }
}
