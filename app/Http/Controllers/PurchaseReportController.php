<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Purchase;

class PurchaseReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase = json_decode(Input::get('purchase'), true);
		return $purchase;
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
        return view('purchase-report.create', Compact('encrypted_token'));
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
		
		$purchases=Purchase::with(['purchase_details'=>function($query){
			$query->with('products');
            $query->with('party');
		}])->
		whereBetween('date', [$fromDate, $toDate])->OrderBy('id', 'asc')->get();
        //return $purchases;		
		return view('purchase-report.create', compact('purchases', 'encrypted_token'));
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
	
	public function print_purchase(Request $request)
    {
		$encrypter = app('Illuminate\Encryption\Encrypter');
		$encrypted_token = $encrypter->encrypt(csrf_token());	
        $fromDate = $request->get('from_date');
		$toDate = $request->get('to_date');
		return $fromDate;
		
		$purchases=Purchase::with(['suppliers', 'purchase_details'=>function($query){
			$query->with('products');
		}])->
		whereBetween('date', [$fromDate, $toDate])->OrderBy('id', 'asc')->get();		
		return $purchases;
		return view('purchase-report.print', compact('purchases', 'encrypted_token'));
    }
}
