<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publisher;
use Session;
class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $publishers = Publisher::OrderBy('id', 'asc')->get();
	 return view('publisher.index', Compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
        return view('publisher.create');
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
		'name' => 'required'
		]);
		
        Publisher::create($request->all());
		Session::flash('flash_message', 'Publisher Added Successfully!');
		return redirect('publisher/create');
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
        $edit = Publisher::findOrFail($id);
		return view('publisher.edit', Compact('edit'));
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
	 'name' => 'required'
	 ]);
	 $update = Publisher::findOrFail($id);
	 $update->update($request->all());
	 Session::flash('flash_message', 'Publisher Updated Successfully!');
	 return redirect('publisher');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $delete = Publisher::findOrFail($id);
	$delete->delete();
	return "Publisher Deleted Successfully!";
    }
}
