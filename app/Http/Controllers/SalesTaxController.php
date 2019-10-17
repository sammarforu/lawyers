<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Catagory;
use App\SalesTax;
use Session;
class SalesTaxController extends Controller
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
    $offices = Catagory::orderby('catagory_name', 'asc')->pluck('catagory_name', 'id')->toArray();
    return view('sales-tax.create', Compact('offices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     //return $request->all();
    $this->validate($request, [
            'voucher_no' => 'required',
            'client_name' => 'required',
            'business_name' => 'required',
            'cell_no' => 'required',
            'cnic' => 'required',
            'cell_no' => 'required',
            'fbr_id' => 'required',
            'fbr_password' => 'required',
            'fbr_pin' => 'required'
        ]);

        $routine = SalesTax::create([
            'created_id' => $request->get('created_id'),
            'voucher_no' => $request->get('voucher_no'),
            'file_no' => $request->get('file_no'),
            'catagory_id' => $request->get('catagory_id'),
            'client_name' => $request->get('client_name'),
            'business_name' => $request->get('business_name'),
            'ntn' => $request->get('ntn'),
            'cnic' => $request->get('cnic'),
            'cell_no' => $request->get('cell_no'),
            'type' => $request->get('type'),
            'fbr_id' => $request->get('fbr_id'),
            'fbr_password' => $request->get('fbr_password'),
            'fbr_pin' => $request->get('fbr_pin'),
        ]);
        // if(!is_null($request->file('attachment')))
        //     {
        //     $imageName = Input::file('attachment')->getClientOriginalName();
        //     $request->file('attachment')->move( base_path() .'/public/upload/ntn/', $imageName);
        //     $routine->attachment = Input::file('attachment')->getClientOriginalName();
        // $routine->save();
        //     }
        Session::flash('flash_message', 'Sales Tax Added Successfully!');
        return redirect('sales-tax/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    $office = Catagory::where('id', '=', $id)->get();
    $ntns = SalesTax::where('catagory_id', '=', $id)->get();
    return view('sales-tax.index', Compact('ntns', 'office'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $edit = SalesTax::findOrFail($id);
    $offices = Catagory::orderby('catagory_name', 'asc')->pluck('catagory_name', 'id')->toArray();
    return  view('sales-tax.edit', Compact('edit', 'offices'));
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
            'voucher_no' => 'required',
            'client_name' => 'required',
            'business_name' => 'required',
            'cell_no' => 'required',
            'cnic' => 'required',
            'cell_no' => 'required',
            'fbr_id' => 'required',
            'fbr_password' => 'required',
            'fbr_pin' => 'required'
        ]);
    $update = SalesTax::findOrFail($id);
        // if(!is_null($request->file('attachment')))
        // {   
        //     $imageName = Input::file('attachment')->getClientOriginalName();
        //     //return $imageName;
        //     $request->file('attachment')->move(
        //         base_path() . '/public/upload/ntn/', $imageName);
        //     $update->update(array(
        //     'attachment' => $imageName
        //     ));
        // }
          $update->update(array(
          'created_id' => $request->get('created_id'),
            'voucher_no' => $request->get('voucher_no'),
            'file_no' => $request->get('file_no'),
            'catagory_id' => $request->get('catagory_id'),
            'client_name' => $request->get('client_name'),
            'business_name' => $request->get('business_name'),
            'ntn' => $request->get('ntn'),
            'cnic' => $request->get('cnic'),
            'cell_no' => $request->get('cell_no'),
            'type' => $request->get('type'),
            'fbr_id' => $request->get('fbr_id'),
            'fbr_password' => $request->get('fbr_password'),
            'fbr_pin' => $request->get('fbr_pin')
        ));
        $update->save();
        
        Session::flash('flash_message', 'Record successfully Updated!');
        return redirect('/sales-tax/' . $request->catagory_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
    $student = SalesTax::findOrFail($id);
        $student->delete(); 
        //return redirect()->back();
        return "Record Successfully Deleted!";
    }

    public function details($id){
    $data = SalesTax::with('biller')->with('office')
    ->where('id', '=', $id)->get();
    return view('sales-tax.details', Compact('data'));
    return $data;
    }
}
