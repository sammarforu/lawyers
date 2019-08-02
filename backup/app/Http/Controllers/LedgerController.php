<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LedgerRequest;
use App\Party;
use App\Ledger;
use App\Setting;
use Session;
use DB;
use PDF;
class LedgerController extends Controller
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
		$ledger = Party::OrderBy('party_name', 'asc')->get();
		//return $ledger;
        return view('ledger.index', Compact('ledger'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$parties = Party::OrderBy('id', 'asc')->pluck('party_name', 'id');
		return view('ledger.create', Compact('parties'));
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
		'date' => 'required',
		'party_id' => 'required'
]);
        Ledger::create($request->all());
		Session::flash('flash_message', 'Entry Added Successfully!');
		return redirect('/ledger/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ledgers = Ledger::join('parties', 'parties.id',  'ledgers.party_id')
						  ->where('party_id', '=', $id)->OrderBy('id', 'asc')->get(['ledgers.*', 'parties.party_name as partyname, parties.phone, parties.city']);
		//return $ledgers;
		$party = Party::OrderBy('party_name', 'asc')->where('id', '=', $id)->get();
		$company_detail = Setting::OrderBy('id', 'asc')->where('id', '=', 1)->get();
		return view('ledger.details', Compact('ledgers', 'party', 'company_detail', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Ledger::findOrFail($id);
		$parties = Party::OrderBy('id', 'asc')->pluck('party_name', 'id');
		return view('ledger.edit', Compact('edit', 'parties'));
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
		'date' => 'required',
		'party_id' => 'required'
]);
        $update = Ledger::findOrFail($id);
		$update->update($request->all());
		Session::flash('flash_message', 'Entry Updated Successfully!');
		return redirect('ledger/create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Ledger::findOrFail($id);
		$delete->delete();
		//return redirect('/ledger/' . $id);
		return "Ledger deleted Successfully!";
    }
	
	public function print_ledger($id)
	{
		$ledgers = Ledger::join('parties', 'parties.id',  'ledgers.party_id')
						  ->where('party_id', '=', $id)->OrderBy('id', 'asc')->get(['ledgers.*', 'parties.party_name as partyname, parties.phone, parties.city']);
		//return $ledgers;
		$party = Party::OrderBy('party_name', 'asc')->where('id', '=', $id)->get();
		$company_detail = Setting::OrderBy('id', 'asc')->where('id', '=', 1)->get();
		return view('ledger.print', Compact('ledgers', 'party', 'company_detail', 'id'));
	}
	
	public function getPDF($id)
	{
	$ledgers = Ledger::join('parties', 'parties.id',  'ledgers.party_id')->OrderBy('id', 'asc')
						  ->where('party_id', '=', $id)->get(['ledgers.*', 'parties.party_name as partyname']);
		$party = DB::table('parties')->select('party_name')->where('id', '=', $id)->get();
	//return $ledgers;
	$pdf = PDF::loadView('ledger.ledgerpdf', ['ledgers' => $ledgers, 'party' => $party]);
	return $pdf->download('ledgerpdf.pdf');
	
	}
}
