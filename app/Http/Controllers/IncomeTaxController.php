<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Catagory;
use App\IncomeTax;
use Session;
class IncomeTaxController extends Controller
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
    return view('income-tax.create', Compact('offices'));
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
            'voucher_no' => 'required',
            'client_name' => 'required',
            'business_name' => 'required',
            'cell_no' => 'required',
            'cnic' => 'required',
            'iris_id' => 'required',
            'iris_password' => 'required',
            'iris_pin' => 'required'
        ]);

        $routine = IncomeTax::create([
            'created_id' => $request->get('created_id'),
            'voucher_no' => $request->get('voucher_no'),
            'file_no' => $request->get('file_no'),
            'catagory_id' => $request->get('catagory_id'),
            'client_name' => $request->get('client_name'),
            'ntn_no' => $request->get('ntn_no'),
            'business_name' => $request->get('business_name'),
            'cnic' => $request->get('cnic'),
            'cell_no' => $request->get('cell_no'),
            'status' => $request->get('status'),
            'iris_id' => $request->get('iris_id'),
            'iris_password' => $request->get('iris_password'),
            'iris_pin' => $request->get('iris_pin'),
        ]);
      
        if(!is_null($request->file('attachment')))
            {
            $imageName = Input::file('attachment')->getClientOriginalName();
            //return $imageName;
            $request->file('attachment')->move( base_path() .'/public/upload/incometax/', $imageName);
            $routine->attachment = Input::file('attachment')->getClientOriginalName();
        $routine->save();
            // return $imageName; 
            }



        Session::flash('flash_message', 'IncomeTax Added Successfully!');
        return redirect('income-tax/create');
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
    $ntns = IncomeTax::where('catagory_id', '=', $id)->get();
    return view('income-tax.index', Compact('ntns', 'office'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $edit = IncomeTax::findOrFail($id);
    $offices = Catagory::orderby('catagory_name', 'asc')->pluck('catagory_name', 'id')->toArray();
    return  view('income-tax.edit', Compact('edit', 'offices'));
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
            'iris_id' => 'required',
            'iris_password' => 'required',
            'iris_pin' => 'required'
        ]);
    $update = IncomeTax::findOrFail($id);
        if(!is_null($request->file('attachment')))
        {   
            $imageName = Input::file('attachment')->getClientOriginalName();
            //return $imageName;
            $request->file('attachment')->move(
                base_path() . '/public/upload/incometax/', $imageName);
            $update->update(array(
            'attachment' => $imageName
            ));
        }
          $update->update(array(
          'created_id' => $request->get('created_id'),
            'voucher_no' => $request->get('voucher_no'),
            'file_no' => $request->get('file_no'),
            'catagory_id' => $request->get('catagory_id'),
            'client_name' => $request->get('client_name'),
            'ntn_no' => $request->get('ntn_no'),
            'business_name' => $request->get('business_name'),
            'cnic' => $request->get('cnic'),
            'cell_no' => $request->get('cell_no'),
            'status' => $request->get('status'),
            'iris_id' => $request->get('iris_id'),
            'iris_password' => $request->get('iris_password'),
            'iris_pin' => $request->get('iris_pin')
        ));
        $update->save();
        
        Session::flash('flash_message', 'Record successfully Updated!');
        return redirect('/income-tax/' . $request->catagory_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $student = IncomeTax::findOrFail($id);
        $student->delete(); 
        //return redirect()->back();
        return "Record Successfully Deleted!";
    }

    public function details($id){
    $data = IncomeTax::with('biller')->with('office')
    ->where('id', '=', $id)->get();
    return view('income-tax.details', Compact('data'));
    return $data;
}
}
