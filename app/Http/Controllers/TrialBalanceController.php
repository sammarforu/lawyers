<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\AccountGroup;
use DB;
class TrialBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

     // $data = AccountGroup::with('general_vouchers')->where('name', '=', 'ASSET')->get();
          $debit = AccountGroup::with(['parties'=> function($query){
                      $query->with('general_vouchers');
                      //$query->groupBy('account_group_id');
                      }])->OrderBy('account_groups.name')->get();
          $debit = AccountGroup::with('parties')->with('general_vouchers')
                      //$query->groupBy('account_group_id');
                      ->OrderBy('account_groups.name')->get();
          $company_detail = Setting::where('id', '=', 1)->get();
          //return $debit;
        //   foreach($debit as $debits){
        //   $test = $debits->name;

        //   return $test;
        // }
    return view('trial-balance.index', Compact('debit', 'credit', 'company_detail'));
  // $data = DB::table('general_vouchers')
  //   ->join('parties', 'parties.id', '=', 'general_vouchers.account_head_id')
  //   ->join('account_groups', 'account_groups.id', '=', 'parties.account_group_id')
  //   ->select('account_groups.name', DB::raw('SUM(debit) as TotalDebit'), DB::raw('SUM(credit) as TotalCredit'))
  //   //->groupBy('account_groups.id')
  //   ->where('general_vouchers.account_head_id', '=', '9')
  //   ->get()->toArray();


                     // $query->groupBy('account_group_id');
                     // }])->where('name', '=', 'ASSET')->get();
         // $data = DB::table('account_groups')
         //           ->join('parties', 'account_groups.id', '=', 'parties.account_group_id')
         //           ->join('general_vouchers', 'general_vouchers.account_head_id', '=', 'parties.id')
         //           ->where('account_groups.id', '=', 4)
         //           ->get()->toArray();
         return $data;

    $debit = DB::table('general_vouchers')
                 ->join('parties', 'parties.id', '=', 'general_vouchers.account_head_id')
                 ->select('parties.party_name', DB::raw('SUM(debit) as total'))
                 ->groupBy('account_head_id')
                // ->where('type', '=', 'Asset')
                // ->whereBetween('sale_details.created_at', [$fromDate, $toDate])
                 ->get()->toArray();

    $credit = DB::table('general_vouchers')
                 ->join('parties', 'parties.id', '=', 'general_vouchers.account_head_id')
                 ->select('parties.party_name', DB::raw('SUM(credit) as total'))
                 ->groupBy('account_head_id')
                // ->where('type', '=', 'Asset')
                // ->whereBetween('sale_details.created_at', [$fromDate, $toDate])
                 ->get()->toArray();
       return $debit;
    
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
