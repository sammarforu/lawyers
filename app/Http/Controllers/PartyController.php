<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests\PartyRequest;
use App\Party;
use App\Setting;
use App\AccountGroup;
use Session;
use PDF;
use Excel;
use DB;
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
		$party = Party::join('account_groups', 'account_groups.id', '=', 'parties.account_group_id')->OrderBy('party_name', 'asc')->get(['parties.*', 'account_groups.name']);
    
        return view('parties.index', Compact('party'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    //$AccountGroups = AccountGroup::OrderBy('name', 'asc')->pluck('name', 'id');
    $AccountGroups = AccountGroup::select(DB::raw('CONCAT(`id`, "_", `name`) AS `id`, `name`'))->OrderBy('name', 'asc')->pluck('name', 'id')->prepend('Select Account')->toArray();
    return view('parties.create', Compact('AccountGroups'));
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
		'account_type' => 'required'
		// 'phone' => 'required',
  //       'city' => 'required',
		// 'address' => 'required',
		// 'type' => 'required'
]);
        Party::create($request->all());
		Session::flash('flash_message', 'Account added Successfully!');
		return redirect('parties/create');
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
    //$AccountGroups = AccountGroup::OrderBy('name', 'asc')->pluck('name', 'id');
    $AccountGroups = AccountGroup::select(DB::raw('CONCAT(`id`, "_", `name`) AS `id`, `name`'))->OrderBy('name', 'asc')->pluck('name', 'id')->prepend('Select Account')->toArray();
	return view('parties.edit', Compact('edit', 'AccountGroups'));
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
		'party_name' => 'required'//,
/*		'phone' => 'required',
        'city' => 'required',
		'address' => 'required',
		'type' => 'required'*/
]);
        $update = Party::findOrFail($id);
		$update->update($request->all());
		Session::flash('flash_message', 'Account Updated Successfully!');
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
	
   public function print_parties()
    {
    $parties = Party::OrderBy('party_name', 'asc')->get();
    $company_detail = Setting::where('id', '=', 1)->get();
    return view('parties.print', Compact('parties', 'company_detail'));
    }
    
    public function getPDF()
    {
    $parties = Party::OrderBy('party_name', 'asc')->get();
    $company_detail = Setting::where('id', '=', 1)->get();
    $pdf = PDF::loadView('parties.partypdf', ['parties' => $parties, 'company_detail' => $company_detail]);
    return $pdf->download('parties.pdf');
    }
    
    public function getExcel()
    {
    $data = Party::OrderBy('party_name', 'asc')->get(['parties.id', 'parties.party_name', 'parties.phone', 'parties.ntn', 'parties.strn', 'parties.city', 'parties.address', 'parties.type'])->toArray();
        return Excel::create('parties', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download();
    }
}
