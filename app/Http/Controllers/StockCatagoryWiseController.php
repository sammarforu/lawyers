<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catagory;
use App\Product;
use App\Setting;
use App\StockRegisterSpecificItem;
use Illuminate\Support\Facades\Input;
class StockCatagoryWiseController extends Controller
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
    $catagories = Catagory::OrderBy('catagory_name', 'asc')->pluck('catagory_name', 'id')->prepend('Select Catagory', '')->toArray();
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
    return view('stock-register-catagory-wise.index', Compact('encrypted_token', 'catagories'));
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
        $this->validate($request, [
    'catagory_id' => 'required'//,
    // 'from_date' => 'required',
    // 'to_date' => 'required'
    ]);
    $CatagoryID = Input::get('catagory_id');
    // $fromDate = $request->get('from_date');
    // $toDate = $request->get('to_date');
    $catagory = Catagory::where('id', '=', $CatagoryID)->get();
    //return $catagory;
    // $items = StockRegisterSpecificItem::join('products', 'products.id', '=', 'stock_register_specific_items.product_id')
    //  ->join('parties', 'parties.id', '=', 'stock_register_specific_items.party_id')
    //  ->OrderBy('stock_register_specific_items.id', 'asc')
    //  ->whereBetween('stock_register_specific_items.date', [$fromDate, $toDate])
    //  ->where('stock_register_specific_items.product_id', '=', $ProductID)->get();

     // $product = Catagory::with(['products' => function($query){
     //                      $query->with('products_detail');
     //                      $query->with('sale_detail');
     //                      $query->with('sale_return_detail');
     //                      $query->with('purchase_return_detail');
     //       }])->OrderBy('catagory_name', 'asc')
     // ->where('products.id',  $CatagoryID)
     // ->get();
     $product = Product::with('products_detail')->with('sale_detail')->with('sale_return_detail')->with('purchase_return_detail')
     ->OrderBy('product_name', 'asc')
     ->where('products.catagory_id',  $CatagoryID)
     ->get();
     //return $product;
    $company_detail = Setting::where('id', '=', 1)->get();
    return view('stock-register-catagory-wise.report', Compact('items', 'company_detail', 'product', 'catagory'));
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
