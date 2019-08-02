<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccountHead;
use App\Party;
use App\Product;
use App\SaleDetail;
use App\PurchaseDetail;
use App\GeneralVoucher;
use App\Setting;
use App\StockRegisterSpecificItem;
use DB;
use Illuminate\Support\Facades\Input;
class StockRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function __construct()
    {
    $this->middleware('auth');
    }
    public function index()
    {
    $products = Product::OrderBy('product_name', 'asc')->pluck('product_name', 'id')->prepend('Select Item', '')->toArray();
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
    return view('stock-register-specific-item.index', Compact('encrypted_token', 'products'));
    }

    public function report(Request $request){
    $this->validate($request, [
    'product_id' => 'required',
    'from_date' => 'required',
    'to_date' => 'required'
    ]);
    $ProductID = Input::get('product_id');
    $fromDate = $request->get('from_date');
    $toDate = $request->get('to_date');
    $product = Product::where('id', '=', $ProductID)->get();
    //return $product;
     $items = StockRegisterSpecificItem::join('products', 'products.id', '=', 'stock_register_specific_items.product_id')
     ->join('parties', 'parties.id', '=', 'stock_register_specific_items.party_id')
     ->OrderBy('stock_register_specific_items.id', 'asc')
     ->whereBetween('stock_register_specific_items.date', [$fromDate, $toDate])
     ->where('stock_register_specific_items.product_id', '=', $ProductID)->get();
     //return $items;
    $company_detail = Setting::where('id', '=', 1)->get();
    return view('stock-register-specific-item.report', Compact('items', 'company_detail', 'product'));
    }

    public function reportFifo(Request $request){
        $this->validate($request, [
    'product_id' => 'required',
    'from_date' => 'required',
    'to_date' => 'required'
    ]);
    $ProductID = Input::get('product_id');
    $fromDate = $request->get('from_date');
    $toDate = $request->get('to_date');
        $productId = Input::get('product_id');
        // $items = Product::with(['party' => function($query){
        //                 $query->with('purchase_detail');
        // }])->with(['sale_detail' => function($query){
        //                 $query->with('unit');
        // }])->with(['purchase_return_detail' => function($query){
        //                 $query->with('unit');
        // }])->with(['sale_return_detail' => function($query){
        //                 $query->with('uoms');
        // }])->where('products.id', '=', $productId)->OrderBy('id', 'asc')->get();
        //return $items;
        $items = StockRegisterSpecificItem::join('products', 'products.id', '=', 'stock_register_specific_items.product_id')
     ->join('parties', 'parties.id', '=', 'stock_register_specific_items.party_id')
     ->OrderBy('stock_register_specific_items.id', 'asc')
     ->whereBetween('stock_register_specific_items.date', [$fromDate, $toDate])
     ->where('stock_register_specific_items.product_id', '=', $ProductID)->get(); 
        $product = Product::where('id', '=', $productId)->get();
        //return $items;
        $company_detail = Setting::where('id', '=', 1)->get();
        return view('stock-register-specific-item.stock-register-specific-item-fifo', Compact('items', 'company_detail'));
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
