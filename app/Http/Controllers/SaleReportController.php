<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sales;
class SaleReportController extends Controller
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
        return view('sale-report.create', Compact('encrypted_token'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$encrypter = app('Illuminate\Encryption\Encrypter');
		$encrypted_token = $encrypter->encrypt(csrf_token());	
        $fromDate = $request->get('from_date');
		$toDate = $request->get('to_date');
		$sales = Sales::with(['parties', 'sale_details'=>function($query){
				$query->with('products');
				}])->
				whereBetween('date', [$fromDate, $toDate])
				->get();
		//$sales=Sales::with(['parties', 'sale_details'=>function($query){
			//$query->with('products');
		//}])->
		//whereBetween('date', [$fromDate, $toDate])->OrderBy('id', 'asc')->get();		
		//return $sales;
		return view('sale-report.create', compact('sales', 'encrypted_token'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
