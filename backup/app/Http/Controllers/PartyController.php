<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests\PartyRequest;
use App\Party;
use App\Setting;
use Session;
use validator;
class PartyController extends Controller
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
		$party = Party::OrderBy('party_name', 'asc')->get();
        return view('parties.index', Compact('party'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parties.create');
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
		'party_name' => 'required',
		'phone' => 'required',
        'city' => 'required',
		'address' => 'required',
		'type' => 'required'
]);
        Party::create($request->all());
		Session::flash('flash_message', 'Party added Successfully!');
		return redirect('parties');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$party = Party::with(['party'=>function($query){
		$query->with('products');
		}])->where('id', '=', $id)->OrderBy('party_name', 'asc')->get();
		$company_detail = Setting::where('id', '=', 1)->get();
		//return $party;
        return view('parties.details', Compact('party', 'company_detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Party::findOrFail($id);
		return view('parties.edit', Compact('edit'));
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
		'party_name' => 'required',
		'phone' => 'required',
        'city' => 'required',
		'address' => 'required',
		'type' => 'required'
]);
        $update = Party::findOrFail($id);
		$update->update($request->all());
		Session::flash('flash_message', 'Party Updated Successfully!');
		return redirect('parties');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Party::findOrFail($id);
		$delete->delete();
		return ("Party has been deleted!");
    }
	
	    public function print_products($id)
    {
		$party = Party::with(['party'=>function($query){
		$query->with('products');
		}])->where('id', '=', $id)->OrderBy('party_name', 'asc')->get();
		$company_detail = Setting::where('id', '=', 1)->get();
        return view('parties.print', Compact('party', 'company_detail'));
    }
}