<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LCAccount;
use Session;
class LCAccountController extends Controller
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
    $accounts = LCAccount::OrderBy('account_name', 'asc')->get();
    return view('lc.lc-account.create', compact('accounts', 'encrypted_token'));  
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
            'account_name' => 'required'
        ]);
        LCAccount::create($request->all());
        Session::flash('flash_message', 'LC Account Added Successfully!');
        return redirect('lc-account/create');
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
    $edit = LCAccount::findOrFail($id);
    return view('lc/lc-account/edit', Compact('edit'));
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
            'account_name' => 'required'
        ]);
        $update = LCAccount::findOrFail($id);
        $update->update($request->all());
        Session::flash('flash_message', 'LC Account Updated Successfully!');
        return redirect('lc-account/create'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $delete = LCAccount::findOrFail($id);
    $delete->delete();
    return "LC Account Deleted Successfully!";
    }
}
