<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CatagoryRequest;
use App\Catagory;
use Session;
use Excel;
class CatagoryController extends Controller
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
		$catagories = Catagory::OrderBy('catagory_name', 'asc')->get();
        return view('catagories.index', Compact('catagories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('catagories.create');
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
		'catagory_code' => 'required',
		'catagory_name' => 'required'
		]);
        Catagory::create($request->all());
		Session::flash('flash_message', 'Catagory Added Successfully!');
		return redirect('catagories/create');
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
     $edit = Catagory::findOrFail($id);
	 return view('catagories.edit', Compact('edit'));
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
		'catagory_code' => 'required',
		'catagory_name' => 'required'
		]);
        $update = Catagory::findOrFail($id);
		$update->update($request->all());
		Session::flash('flash_message', 'Catagory Updated Successfully!');
		return redirect('catagories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Catagory::findOrFail($id);
		$delete->delete();
		return "Catagory Deleted Successfully!";
    }

    public function createImportExcel()
    {
        return view('catagories.importExcel.create');
    }


      public function ImportExcel(Request $request)
    {
        $this->validate($request, [
            'import_file' => 'required'
        ]);
        $path = $request->file('import_file')->getRealPath();
        $results = Excel::load($path)->get();
        if(!empty($results) && $results->count()){
        foreach ($results as $rows) {
          foreach ($rows as $row) {
            if (($row->catagory_name)!=null){
          Catagory::create([
                'catagory_code'  => $row->catagory_code,
                'catagory_name'  => $row->catagory_name,
                ]);
              }
            }
          }
      }

    Session::flash('flash_message', 'Excel Sheet Imported Successfully!');
        return redirect('catagories/importExcel/create');
    }
}
