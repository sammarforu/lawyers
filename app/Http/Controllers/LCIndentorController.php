<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LCIndentor;
use Session;
class LCIndentorController extends Controller
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
    $indentors = LCIndentor::OrderBy('indentor_name', 'asc')->get();
    return view('lc.indentor-info.create', compact('indentors', 'encrypted_token'));    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'indentor_name' => 'required'
        ]);
        LCIndentor::create($request->all());
        Session::flash('flash_message', 'Indentor Added Successfully!');
        return redirect('indentor-info/create');
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
    $edit = LCIndentor::findOrFail($id);
    return view('lc/indentor-info/edit', Compact('edit'));
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
            'indentor_name' => 'required'
        ]);
        $update = LCIndentor::findOrFail($id);
        $update->update($request->all());
        Session::flash('flash_message', 'Indentor Updated Successfully!');
        return redirect('indentor-info/create');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $delete = LCIndentor::findOrFail($id);
    $delete->delete();
    return "Indentor Deleted Successfully!";
    }
}
