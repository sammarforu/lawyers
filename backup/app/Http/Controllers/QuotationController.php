<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QuotationRequest;
use App\Quotation;
use Session;
use PDF;
class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotations = Quotation::OrderBy('id', 'asc')->get();
		return view('quotation.index', Compact('quotations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quotation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuotationRequest $request)
    {
        Quotation::create($request->all());
		Session::flash('flash_message', 'Quotation Added Successfully!');
		return redirect('quotation/create');
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
        $edit = Quotation::findOrFail($id);
		return view('quotation.edit', Compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuotationRequest $request, $id)
    {
        $update=Quotation::findOrFail($id);
		$update->update($request->all());
		Session::flash('flash_message', 'Quotation Updated Successfully!');
		return redirect('quotation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Quotation::findOrFail($id);
		$delete->delete();
		return "Quotation has been deleted Successfully!";
    }
	
	
	public function getPDF()
	{
	$quotations = Quotation::all();
	$pdf = PDF::loadView('quotation.quotationpdf', ['quotations' => $quotations]);
	return $pdf->download('quotationpdf.pdf');
	
	}
}
