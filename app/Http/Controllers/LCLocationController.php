<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LCLocation;
use Session;
class LCLocationController extends Controller
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
    $encrypter = app('Illuminate\Encryption\Encrypter');
    $encrypted_token = $encrypter->encrypt(csrf_token());
    $locations = LCLocation::OrderBy('location_name', 'asc')->get();
    return view('lc.location.create', compact('locations', 'encrypted_token')); 
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
            'location_name' => 'required'
        ]);
        LCLocation::create($request->all());
        Session::flash('flash_message', 'LC Location Added Successfully!');
        return redirect('lc-location/create');
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
    $edit = LCLocation::findOrFail($id);
    return view('lc/location/edit', Compact('edit'));
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
            'location_name' => 'required'
        ]);
        $update = LCLocation::findOrFail($id);
        $update->update($request->all());
        Session::flash('flash_message', 'LC Location Updated Successfully!');
        return redirect('lc-location/create'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $delete = LCLocation::findOrFail($id);
    $delete->delete();
    return "LC Location Deleted Successfully!";
    }
}
