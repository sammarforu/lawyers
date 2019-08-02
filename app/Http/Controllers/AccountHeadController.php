<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountHead;
use App\Setting;
use App\Party;
use Session;
class AccountHeadController extends Controller
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
    $heads = AccountHead::OrderBy('title')->get();
    return view('account-head.index', Compact('heads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('account-head.create');
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
        'account_group' => 'required',
        'title' => 'required',
        'account_no' => 'required|unique:account_heads'
        ]);
        AccountHead::create($request->all());
        Session::flash('flash_message', 'Account Head Added Successfully!');
        return redirect('account-head/create');
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
    $edit = AccountHead::findOrFail($id);
    return view('account-head.edit', Compact('edit'));
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
        'account_no' => 'required'
        ]);
        $update = AccountHead::findOrFail($id);
        $update->update($request->all());
        Session::flash('flash_message', 'Account Head Updated Successfully!');
        return redirect('account-head');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $delete = AccountHead::findOrFail($id);
        $delete->delete();
        return "Account Head Deleted Successfully!";
    }

    public function PrintLedger($id){
        $ledgers  = AccountHead::with('ledger_details')->where('id', '=', $id)->get();
        $company_detail = Setting::OrderBy('id', 'asc')->where('id', '=', 1)->get();
        return view('account-head.print', Compact('ledgers', 'company_detail', 'party'));
        //return $ledgers;
    }
}
