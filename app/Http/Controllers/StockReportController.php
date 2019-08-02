<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Setting;
use App\Catagory;
class StockReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AllItems(){
        //Stock Report in pcs only
        // $products = Catagory::with('products')(['purchase_detail'])->with('sale_detail')->with('challan_detail')->with('sale_return_detail')->with('purchase_return_detail')->OrderBy('product_name', 'asc')->get();
        // return $products;
          $product = Catagory::with(['products' => function($query){
                          $query->with('products_detail');
                          $query->with('sale_detail');
                          $query->with('sale_return_detail');
                          $query->with('purchase_return_detail');
           }])->OrderBy('catagory_name', 'asc')->get();
        //return $product;
        //return $products;
        //Stock Report ON different units
         // $products = Product::with(['products_detail' => function($query){
         //                 $query->with('unit');
         //  }])->with(['sale_detail' => function($query){
         //                  $query->with('unit');
         //  }])->with(['purchase_return_detail' => function($query){
         //                  $query->with('unit');
         //  }])->with(['sale_return_detail' => function($query){
         //                  $query->with('uoms');
         // }])->with('challan_detail')->OrderBy('product_name', 'asc')->get();
        //return $products;
        $company_detail = Setting::where('id', '=', 1)->get();
        //return view('stock-report.stock-in-pcs', Compact('products', 'company_detail'));
        return view('stock-report.stock-in-pcs', Compact('product', 'company_detail'));

    }

        public function StockInPcs(){
        $products = Product::with(['grn_detail'])->with('sale_detail')->with('challan_detail')->with('sale_return_detail')->with('purchase_return_detail')->OrderBy('product_name', 'asc')->get();
        //return $products;
        $company_detail = Setting::where('id', '=', 1)->get();
        return view('stock-report.all-items', Compact('products', 'company_detail'));

    }
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
