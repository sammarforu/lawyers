<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Party;
use App\Setting;
use App\GeneralVoucher;
use App\AccountGroup;
use DB;
class BalanceSheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $data = AccountGroup::with('general_vouchers')->where('name', '=', 'ASSET')->get();
        // $data = AccountGroup::with(['parties'=> function($query){
        //             $query->with('general_vouchers');
        //             }])->where('name', '=', 'ASSET')->get();
        // return $data;
     $asset = DB::table('general_vouchers')
    //->join('account_groups', 'account_groups.id', '=', 'general_vouchers.account_head_id')
    ->join('parties', 'parties.id', '=', 'general_vouchers.account_head_id')
    ->select('parties.party_name', DB::raw('SUM(debit) as total'))
    ->groupBy('account_head_id')
    ->where('parties.account_group_id', '=', '3')
                // ->whereBetween('sale_details.created_at', [$fromDate, $toDate])
    ->get()->toArray();
           
    $liabilitity = DB::table('general_vouchers')
                 ->join('parties', 'parties.id', '=', 'general_vouchers.account_head_id')
                 ->select('parties.party_name', DB::raw('SUM(credit) as total'))
                 ->groupBy('account_head_id')
                 ->where('parties.account_group_id', '=', '4')
                // ->whereBetween('sale_details.created_at', [$fromDate, $toDate])
                 ->get()->toArray();
                 //return $liabilitity;
    $company_detail = Setting::where('id', '=', 1)->get();
    //return $asset;
    return view('balance-sheet.index', Compact('asset', 'liabilitity', 'company_detail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
