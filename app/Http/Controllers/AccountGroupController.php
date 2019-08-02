<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountGroup;
use Session;
class AccountGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $groups = AccountGroup::OrderBy('name', 'asc')->get();
        return view('account-group.index', Compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('account-group.create');
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
        AccountGroup::create($request->all());
        Session::flash('flash_message', 'Account Group Successfully!');
        return redirect('account-group/create');
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
    $edit = AccountGroup::findOrFail($id);
     return view('account-group.edit', Compact('edit'));
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
        'code' => 'required',
        'name' => 'required'
        ]);
        $update = AccountGroup::findOrFail($id);
        $update->update($request->all());
        Session::flash('flash_message', 'Account Group Updated Successfully!');
        return redirect('account-group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $delete = AccountGroup::findOrFail($id);
        $delete->delete();
        return "Account Head Deleted Successfully!";
    }
}
