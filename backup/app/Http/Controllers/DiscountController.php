<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discount;
use Session;
use Illuminate\Support\Facades\Input;
class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::OrderBy('id', 'asc')->get();
		return view('discount.index', Compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discount.create');
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
		'title' => 'required',
		'discount' => 'required',
		'type' => 'required'
		]);
		Discount::create($request->all());
		Session::flash('flash_message', 'Discount Added Successfully!');
		return redirect('discount');
		
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
        $edit = Discount::findOrFail($id);
		return view('discount.edit', Compact('edit'));
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
		'title' => 'required',
		'discount' => 'required',
		'type' => 'required'
		]);
		$update = Discount::findOrFail($id);
		$update->update($request->all());
		Session::flash('flash_message', 'Discount Updated Successfully!');
		return redirect('discount');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Discount::findOrFail($id);
		$delete->delete();
		return "Discount Deleted Successfully";
    }
}
