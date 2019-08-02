<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\SaleDetail;
use App\PurchaseDetail;
use DB;
class ReportsController extends Controller
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
    public function chartjs()
    {
        	 
    }
	
	public function index()
	{
	$purchase = PurchaseDetail::select(DB::raw("SUM(total_cost) as count"))
        ->orderBy("created_at")
        ->groupBy(DB::raw("year(created_at)"))
        ->get()->toArray();
    $purchase = array_column($purchase, 'count');
    
    $sale = SaleDetail::select(DB::raw("SUM(total_cost) as count"))
        ->orderBy("created_at")
        ->groupBy(DB::raw("year(created_at)"))
        ->get()->toArray();
    $sale = array_column($sale, 'count');

    return view('reports.index')
            ->with('purchase',json_encode($purchase,JSON_NUMERIC_CHECK))
            ->with('sale',json_encode($sale,JSON_NUMERIC_CHECK));		
	}
	
	public function month()
	{
	$purchase = PurchaseDetail::select(DB::raw("SUM(total_cost) as count"))
        ->orderBy("created_at")
        ->groupBy(DB::raw("month(created_at)"))
        ->get()->toArray();
    $purchase = array_column($purchase, 'count');
    //return $purchase;
    $sale = SaleDetail::select(DB::raw("SUM(total_cost) as count"))
        ->orderBy("created_at")
        ->groupBy(DB::raw("month(created_at)"))
        ->get()->toArray();
    $sale = array_column($sale, 'count');
	//return $sale;
    return view('reports.month')
            ->with('purchase',json_encode($purchase,JSON_NUMERIC_CHECK))
            ->with('sale',json_encode($sale,JSON_NUMERIC_CHECK));		
	//return view('reports.month');
	}
	
	public function days()
	{
	$purchase = PurchaseDetail::select(DB::raw("SUM(total_cost) as count"))
        ->orderBy("created_at")
        ->groupBy(DB::raw("day(created_at)"))
        ->get()->toArray();
    $purchase = array_column($purchase, 'count');
    //return $purchase;
    $sale = SaleDetail::select(DB::raw("SUM(total_cost) as count"))
        ->orderBy("created_at")
        ->groupBy(DB::raw("day(created_at)"))
        ->get()->toArray();
    $sale = array_column($sale, 'count');
	//return $sale;
    return view('reports.day')
            ->with('purchase',json_encode($purchase,JSON_NUMERIC_CHECK))
            ->with('sale',json_encode($sale,JSON_NUMERIC_CHECK));		
	//return view('reports.month');
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
