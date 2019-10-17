<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Catagory;
use App\PRA;
use Session;
class PRAController extends Controller
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
    return view('pra.create', Compact('offices'));
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
            'pra_id' => 'required',
            'pra_password' => 'required',
            'pra_pin' => 'required'
        ]);

        $routine = PRA::create([
            'created_id' => $request->get('created_id'),
            'voucher_no' => $request->get('voucher_no'),
            'file_no' => $request->get('file_no'),
            'catagory_id' => $request->get('catagory_id'),
            'client_name' => $request->get('client_name'),
            'business_name' => $request->get('business_name'),
            'ntn' => $request->get('ntn'),
            'cnic' => $request->get('cnic'),
            'cell_no' => $request->get('cell_no'),
            'reference_no' => $request->get('reference_no'),
            'pra_id' => $request->get('pra_id'),
            'pra_password' => $request->get('pra_password'),
            'pra_pin' => $request->get('pra_pin')
        ]);
         if(!is_null($request->file('attachment')))
             {
             $imageName = Input::file('attachment')->getClientOriginalName();
             $request->file('attachment')->move( base_path() .'/public/upload/pra/', $imageName);
             $routine->attachment = Input::file('attachment')->getClientOriginalName();
         $routine->save();
             }
        Session::flash('flash_message', 'PRA Added Successfully!');
        return redirect('pra/create');
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
    $ntns = PRA::where('catagory_id', '=', $id)->get();
    return view('pra.index', Compact('ntns', 'office'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $edit = PRA::findOrFail($id);
    $offices = Catagory::orderby('catagory_name', 'asc')->pluck('catagory_name', 'id')->toArray();
    return  view('pra.edit', Compact('edit', 'offices'));
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
            'pra_id' => 'required',
            'pra_password' => 'required',
            'pra_pin' => 'required'
        ]);
    $update = PRA::findOrFail($id);
         if(!is_null($request->file('attachment')))
         {   
             $imageName = Input::file('attachment')->getClientOriginalName();
             //return $imageName;
             $request->file('attachment')->move(
                 base_path() . '/public/upload/pra/', $imageName);
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
            'business_name' => $request->get('business_name'),
            'ntn' => $request->get('ntn'),
            'cnic' => $request->get('cnic'),
            'cell_no' => $request->get('cell_no'),
            'reference_no' => $request->get('reference_no'),
            'pra_id' => $request->get('pra_id'),
            'pra_password' => $request->get('pra_password'),
            'pra_pin' => $request->get('pra_pin')
        ));
        $update->save();
        
        Session::flash('flash_message', 'PRA successfully Updated!');
        return redirect('/pra/' . $request->catagory_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $student = PRA::findOrFail($id);
        $student->delete(); 
        //return redirect()->back();
        return "Record Successfully Deleted!";
    }

    public function details($id){
    $data = PRA::with('biller')->with('office')
    ->where('id', '=', $id)->get();
    return view('pra.details', Compact('data'));
    return $data;
    }
}
