<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Product;
use App\Tax;
use App\Party;
use App\Discount;
use App\Sales;
use App\SaleDetail;
use App\Setting;
use App\Ledger;
use App\Repairing;
use App\RepairingDetail;
use DB;

class RepairingController extends Controller
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
	$sales = Repairing::OrderBy('id', 'dsc')->with(['repairing_details'=>function($query){
					$query->with('products');
					}])->with('parties')->get();
	//return $sales;
	return view('repairing.index', Compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function create()
    {
		$products = Product::OrderBy('product_name', 'asc')->pluck('product_name', 'id')->prepend('Select Product', '0')->toArray();
		//$taxes = Tax::select(DB::raw('CONCAT(`id`, "_", `tax_rate`) AS `tax_rate`, `tax_title`'))->OrderBy('id', 'asc')->pluck('tax_title', 'tax_rate')->toArray();
		//$discounts = Discount::select(DB::raw('CONCAT(`id`, "_", `discount`) AS `discount`, `title`'))->OrderBy('id', 'asc')->pluck('title', 'discount')->toArray();
		$reference = Repairing::count();
		$reference = $reference + 1;
		$customers = Party::OrderBy('id', 'asc')->pluck('party_name', 'id');
		$encrypter = app('Illuminate\Encryption\Encrypter');
		$encrypted_token = $encrypter->encrypt(csrf_token());
        return view('repairing.create', Compact('customers', 'products', 'reference', 'encrypted_token'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
           public function store(Request $request)
    {
		
		$purchase = json_decode(Input::get('purchase'), true);
		$purchase['date'] = date('Y-m-d',strtotime($purchase['date']));
		$products = Input::get('product_data');		
		$purchaseData = Repairing::create($purchase);
		
		foreach($products as $product)
		{
			$purchaseDetail = new RepairingDetail();
			$purchaseDetail->repairing_id = $purchaseData['id'];
			$purchaseDetail->product_id = $product['product_id'];
			$purchaseDetail->party_id = $purchaseData['party_id'];
			//$purchaseDetail->discount = $product['discount'];
			$purchaseDetail->quantity = $product['quantity'];
			$purchaseDetail->charges = $product['charges'];
			$purchaseDetail->save();
		}
		return "inserted";
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$newsale_detail = Repairing::with(['repairing_details'=>function($query){
								$query->with('products');
								$query->with('parties');
								}])
								->where('repairings.id', '=', $id)
								->get();
		$company_detail = Setting::where('id', '=', 1)->get();
		return view('repairing.details', Compact('newsale_detail', 'company_detail'));
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
	
	public function print_repair($id)
    {
		$newsale_detail = Repairing::with(['repairing_details'=>function($query){
								$query->with('products');
								$query->with('parties');
								}])
								->where('repairings.id', '=', $id)
								->get();
		$ledgers = Ledger::with('ledger_party')->where('party_id', '=', $newsale_detail[0]->parties->id)->get();
		//return $ledgers;
		$company_detail = Setting::where('id', '=', 1)->get();
		return view('repairing.print', Compact('newsale_detail', 'company_detail', 'ledgers'));
	}
}
