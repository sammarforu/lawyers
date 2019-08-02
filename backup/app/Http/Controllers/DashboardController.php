<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseDetail;
use App\SaleDetail;
use App\Party;
use App\Supplier;
use App\Product;
use App\User;
use DB;
use date;
use Carbon\Carbon;
class DashboardController extends Controller
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
		$party = Party::count();
		$supplier = Supplier::count();
		$product = Product::count();
		$user = User::count();
        $purchases = DB::table('purchase_details')->Sum('total_cost');
        $sales = DB::table('sale_details')->Sum('total_cost');
        $expenses = DB::table('expenses')->Sum('expense');
        //$todaySale = DB::table('sale_details')->whereDate('created_at', DB::raw('CURDATE()'))->get();
        $todayPurchase = PurchaseDetail::whereDate('created_at', DB::raw('CURDATE()'))->get();
        $totalPurchase = 0;
        foreach($todayPurchase As $allpurchases){
            $totalPurchase = $totalPurchase + $allpurchases->total_cost;
        }

        $todaySale = SaleDetail::whereDate('created_at', DB::raw('CURDATE()'))->get();
        $totalSale = 0;
        foreach($todaySale As $allsales){
            $totalSale = $totalSale + $allsales->total_cost;
        }
        
		//return $totalPurchase;
        return view('dashboard.index', Compact('party', 'supplier', 'product', 'user', 'purchases', 'sales', 'expenses', 'todaySale', 'totalSale', 'totalPurchase'));
    }
	
	
	public function calender()
	{
	return view('calender.index');
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
