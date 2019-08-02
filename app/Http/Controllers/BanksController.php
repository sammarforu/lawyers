<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banks;
use Session;
class BanksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $banks = Banks::OrderBy('id', 'asc')->get();
    return view('banks.index', Compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('banks.create');
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
        'code' => 'required',
        'name' => 'required'
    ]);
    Banks::create($request->all());
    Session::flash('flash_message', 'Bank Added Successfully!');
    return redirect('banks/create');
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
    $edit = Banks::findOrFail($id);
    return view('banks.edit', Compact('edit'));
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
        'code' => 'required',
        'name' => 'required'
        ]);
        $update = Banks::findOrFail($id);
        $update->update($request->all());
        Session::flash('flash_message', 'Bank Updated Successfully!');
        return redirect('banks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $delete = Banks::findOrFail($id);
    $delete->delete();
    return "Bank Deleted Successfully!";
    }
}
