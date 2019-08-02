<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Product;
use App\Tax;
use App\SystemLogo;
use App\Purchase;
use App\PurchaseDetail;
use Illuminate\Support\Facades\Input;
use DB;
use Carbon\Carbon;

class PurchaseController extends Controller
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
	$purchases = Purchase::with(['purchase_details'=>function($query){
							$query->with('purchase_tax');
							}])->with('suppliers')->get();
	//return $purchases;
	//$purchases = $produsts[0];
	return view('purchases.index', Compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$products = Product::OrderBy('product_name', 'asc')->pluck('product_name', 'id')->prepend('Select Product', '0')->toArray();
		$taxes = Tax::select(DB::raw('CONCAT(`id`, "_", `tax_rate`) AS `tax_rate`, `tax_title`'))->OrderBy('id', 'asc')->pluck('tax_title', 'tax_rate')->toArray();
		$suppliers = Supplier::OrderBy('id', 'asc')->pluck('name', 'id');
		
		$encrypter = app('Illuminate\Encryption\Encrypter');
		$encrypted_token = $encrypter->encrypt(csrf_token());
		
        return view('purchases.create', Compact('suppliers', 'products', 'taxes', 'encrypted_token'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		//$this->validate($request, [
		//'reference_no' => 'required'
		//]);
		$purchase = json_decode(Input::get('purchase'), true);
		$purchase['date'] = date('Y-m-d',strtotime($purchase['date']));
		$products = Input::get('product_data');		
		$purchaseData = Purchase::create($purchase);
		
		foreach($products as $product)
		{
			$purchaseDetail = new PurchaseDetail();
			$purchaseDetail->purchase_id = $purchaseData['id'];
			$purchaseDetail->product_id = $product['product_id'];
			$purchaseDetail->tax_id = $product['tax_id'];
			$purchaseDetail->quantity = $product['quantity'];
			$purchaseDetail->unit_cost = $product['unit_cost'];
			$purchaseDetail->total_cost = $product['total_cost'];
			$purchaseDetail->save();
		}
		return $purchaseData['id'];
		//return "inserted";
		
    }
	
		public function unit_cost()
	{
		$purchaseId = Input::get('purchasetab_id');
		$productsArray = Product::where('id', '=', $purchaseId)->get();
		return $productsArray;
	}
	
		public function purchase_json()
	{
		$productId = Input::get('purchase_id');
		$productsArray = Product::where('id', '=', $productId)->get(['products.product_cost AS product_newcost']);
		return $productsArray;
	}
	
		public function quantity_json()
	{
		$productId = Input::get('quantity_id');
		$productsArray = Product::where('id', '=', $productId)->get(['products.product_cost AS product_newcost']);
		return $productsArray;
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$detail = Purchase::with(['purchase_details'=>function($query){
							$query->with('purchase_tax');
							$query->with('products');
							}])->with('suppliers')->where('purchases.id', '=', $id)->get();
		//return $detail;
		$purchase_detail = $detail[0];
		return view('purchases.details', Compact('purchase_detail'));
	}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
   public function edit($id)
    {
		$purchase = Purchase::with(['purchase_details'=>function($query){
									$query->with('purchase_tax');
							}])->where('purchases.id', '=', $id)->get();
		$edit = $purchase[0];
        $products = Product::OrderBy('product_name', 'asc')->pluck('product_name', 'id')->prepend('Select Product', '0')->toArray();
		$taxes = Tax::select(DB::raw('CONCAT(`id`, "_", `tax_rate`) AS `tax_rate`, `tax_title`'))->OrderBy('tax_title', 'asc')->pluck('tax_title', 'tax_rate')->prepend('Select Tax', '0.00')->toArray();
		$suppliers = Supplier::OrderBy('id', 'asc')->pluck('name', 'id');
		
		//$encrypter = app('Illuminate\Encryption\Encrypter');
		//$encrypted_token = $encrypter->encrypt(csrf_token());
		//return $edit;
        return view('purchases.edit', Compact('edit', 'products', 'taxes' , 'suppliers'));
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
		$objPurchase = Purchase::findOrFail($id);
		$purchase = json_decode(Input::get('purchase'), true);
		$objPurchase->supplier_id = $purchase['supplier_id'];
		$objPurchase->reference_no = $purchase['reference_no'];
		//return $objPurchase;
		$objPurchase->date = date('Y-m-d',strtotime($purchase['date']));
		
		$objPurchase->save();

		PurchaseDetail::where('purchase_id', '=', $id)->delete();
		
		$products = Input::get('product_data');		
		
		foreach($products as $product)
		{
			$purchaseDetail = new PurchaseDetail();
			$purchaseDetail->purchase_id = $objPurchase->id;
			$purchaseDetail->product_id = $product['product_id'];
			$purchaseDetail->tax_id = $product['tax_id'];
			$purchaseDetail->quantity = $product['quantity'];
			$purchaseDetail->unit_cost = $product['unit_cost'];
			$purchaseDetail->total_cost = $product['total_cost'];
			$purchaseDetail->save();
		}
		return "updated";        
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

    public function codeMouseUp()
	{
		$productId = Input::get('entered_code');
		//return $productId;
		$productsArray = Product::where('product_code', '=', $productId)->get(['products.*']);
		return $productsArray;
	}

		public function productMouseUp()
	{
		$productName = Input::get('product_name');
		//return $productName;
		 $productsArray = Product::where('product_english', '=', $productName)->get(['products.*']);
		//$productsArray = Product::where('product_name', 'like', '%'.$productName.'%')->get(['products.*']);
		return $productsArray;
	}
	
	public function print_purchase($id)
	{
	$detail = Purchase::with(['purchase_details'=>function($query){
							$query->with('purchase_tax');
							$query->with('products');
							}])->with('suppliers')->where('purchases.id', '=', $id)->get();
		//return $detail;
		$purchase_detail = $detail[0];
		//return $purchase_detail;
		return view('purchases.print', Compact('purchase_detail'));
	}
}
