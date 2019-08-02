<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;
use Session;
class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $warehouses = Warehouse::OrderBy('id', 'asc')->get();
    return view('warehouses.index', Compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('warehouses.create');
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
        'code' => 'required',
        'name' => 'required'
        ]);
    Warehouse::create($request->all());
    Session::flash('flash_message', 'Warehouses Added Successfully!');
    return redirect('warehouses/create');
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
    $edit = Warehouse::findOrFail($id);
    return view('warehouses.edit', Compact('edit'));
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
        $update = Warehouse::findOrFail($id);
        $update->update($request->all());
        Session::flash('flash_message', 'Warehouse Updated Successfully!');
        return redirect('warehouses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $delete = Warehouse::findOrFail($id);
        $delete->delete();
        return "Warehouse Deleted Successfully!";
    }
}
