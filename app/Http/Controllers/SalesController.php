<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Product;
use App\PurchaseDetail;
use App\Tax;
use App\Party;
use App\Discount;
use App\Sales;
use App\SaleDetail;
use App\Setting;
use App\Ledger;
use App\DeliveryChallan;
use App\DeliveryChallanDetail;
use App\GeneralVoucher;
use App\StockRegisterSpecificItem;
use App\LedgerDetailWise;
use App\SystemLogo;
use App\UOM;
use App\Warehouse;
use DB;
use PDF;
//use Carbon\Carbon;
class SalesController extends Controller
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
	$sales = Sales::OrderBy('id', 'dsc')->with(['sale_details'=>function($query){
					//$query->with('taxes');
					$query->with('discount');
					$query->with('parties');
					}])->with('billers')->get();
	//return $sales;
	return view('sales.index', Compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function create()
    {
    	$code = Sales::OrderBy('id', 'asc')->get();
		$codes = $code->last()->invoice_no + 1;
		 $DeliveryChallan = DeliveryChallan::where('status', '=', 'Pending')->OrderBy('dcn_no', 'asc')->pluck('dcn_no', 'dcn_no')->prepend('Select Challan', '0')->toArray();
		// return $DeliveryChallan;
		$products = Product::select(DB::raw('CONCAT(`id`, "_", `product_name`) AS `id`, `product_name`'))->OrderBy('id', 'asc')->pluck('product_name', 'id')->prepend('Select Product', '0')->toArray();
		$taxes = Tax::select(DB::raw('CONCAT(`id`, "_", `tax_rate`) AS `tax_rate`, `tax_title`'))->OrderBy('id', 'asc')->pluck('tax_title', 'tax_rate')->toArray();
		$discounts = Discount::select(DB::raw('CONCAT(`id`, "_", `discount`) AS `discount`, `title`'))->OrderBy('id', 'asc')->pluck('title', 'discount')->toArray();
		//$discounts = Discount::OrderBy('id', 'asc')->pluck('title', 'id')->prepend('Select Discount', '0')->toArray();
		$customers = Party::join('account_groups', 'account_groups.id', '=', 'parties.account_group_id')
            ->where('parties.account_group_id', '=', '1')
            ->Orwhere('parties.account_group_id', '=', '8')
            ->OrderBy('party_name', 'asc')->pluck('party_name', 'parties.id')->prepend('Cash Customer', '1');
		//return $customers;
        $uoms = UOM::select(DB::raw('CONCAT(`id`, "_", `uom`) AS `id`, `uom`'))->OrderBy('id', 'asc')->pluck('uom', 'id')->prepend('PCS', '2_PCS')->toArray();
        //return $uoms;
        $warehouse = Warehouse::OrderBy('name', 'asc')->pluck('name', 'id')->toArray();
		$encrypter = app('Illuminate\Encryption\Encrypter');
		$encrypted_token = $encrypter->encrypt(csrf_token());
		//return $products;
        return view('sales.create', Compact('customers', 'products', 'codes', 'taxes', 'discounts', 'DeliveryChallan', 'encrypted_token', 'uoms', 'warehouse'));
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
		$purchaseData = Sales::create($purchase);
		//$purchaseData->created_at = Carbon::now();
	// 	if($purchaseData->dcn_no !="0"){
	// 	$project = DeliveryChallan::where("dcn_no", $purchaseData->dcn_no)->first();
	// 	$project->status = "Added";
	// 	$project->save();
	// }
		$sum = "0";
		$tot = "0";
		foreach($products as $product)
		{
			$purchaseDetail = new SaleDetail();
			$purchaseDetail->sale_id = $purchaseData['id'];
			$purchaseDetail->product_id = $product['product_id'];
			$purchaseDetail->party_id = $product['party_id'];
			$purchaseDetail->uom_id = $product['uom_id'];
			$purchaseDetail->quantity = $product['quantity'];
			$purchaseDetail->product_cost = $product['product_cost'];
			$purchaseDetail->cost_amount = $product['cost_amount'];
			$purchaseDetail->discount_id = $product['discount_id'];
			$purchaseDetail->warehouse_id = $purchaseData['warehouse_id'];
			$purchaseDetail->sale_rate = $product['sale_rate'];
			$purchaseDetail->sale_amount = $product['balance'];
			$sum = $sum + $product['balance'];			
			$purchaseDetail->save();

			$vouchers = new StockRegisterSpecificItem();
			$vouchers->sale_id = $purchaseData['id'];
			$vouchers->date = $purchaseData['date'];
			$vouchers->party_id = $product['party_id'];
			$vouchers->product_id = $product['product_id'];
			$vouchers->voucher_type = $purchaseData['sale_list'];
			$vouchers->sale_quantity = $product['quantity'];
			$vouchers->cost_rate = $product['balance'];
			$vouchers->save();

		if(($purchaseData['sale_type']) =="Cash Sale"){
			$vouchers = new LedgerDetailWise();
			$vouchers->sale_id = $purchaseData['id'];
			$vouchers->party_id = $product['party_id'];
			$vouchers->voucher_no = $purchaseData['invoice_no'];
			$vouchers->voucher_type = $purchaseData['sale_type'];
			$vouchers->date = $purchaseData['date'];
			$vouchers->product_id = $product['product_id'];
			$vouchers->quantity = $product['quantity'];
			$vouchers->rate = $product['sale_rate'];
			$vouchers->credit = $product['balance'];
			$vouchers->save();
		}
		if(($purchaseData['sale_type']) =="Credit Sale"){
			$vouchers = new LedgerDetailWise();
			$vouchers->sale_id = $purchaseData['id'];
			$vouchers->party_id = $product['party_id'];
			$vouchers->voucher_no = $purchaseData['invoice_no'];
			$vouchers->voucher_type = $purchaseData['sale_type'];
			$vouchers->date = $purchaseData['date'];
			$vouchers->product_id = $product['product_id'];
			$vouchers->quantity = $product['quantity'];
			$vouchers->rate = $product['sale_rate'];
			$vouchers->debit = $product['balance'];
			$vouchers->save();
		}

			

			// $data = PurchaseDetail::where('product_id', '=', $purchaseDetail->product_id)->where('remaining_quantity', '!=', 0)->OrderBy('id', 'asc')->first();
			
			// if($purchaseDetail->quantity > $data->remaining_quantity){
			// 	$tot = (int) $purchaseDetail->quantity - (int) $data->remaining_quantity;
			// 	$data->remaining_quantity = 0;
			// 	$data->save();
				
			// 	$data = PurchaseDetail::where('product_id', '=', $purchaseDetail->product_id)->where('remaining_quantity', '!=', 0)->OrderBy('id', 'asc')->first();
			// 	$tot = (int)$data->remaining_quantity - (int)$tot;
			// 	$data->remaining_quantity = $tot;
			// 	$data->save();

			// }
			// else{
			// 	$data->remaining_quantity =  (int) $data->remaining_quantity - (int) $purchaseDetail->quantity;
			// $data->save();
			// }
		}

		   

		if(($purchaseData['sale_type']) =="Cash Sale"){
			$vouchers = new GeneralVoucher();
			$vouchers->sale_id = $purchaseData['id'];
			$vouchers->account_head_id = $purchaseData['party_id'];
			$vouchers->date = $purchaseData['date'];
			$vouchers->voucher_no = $purchaseData['invoice_no'];
			$vouchers->v_type = $purchaseData['sale_type'];
			$vouchers->credit = $sum;
			$vouchers->save();
		}
		if(($purchaseData['sale_type']) =="Credit Sale"){
			$vouchers = new GeneralVoucher();
			$vouchers->sale_id = $purchaseData['id'];
			$vouchers->account_head_id = $purchaseData['party_id'];
			$vouchers->date = $purchaseData['date'];
			$vouchers->voucher_no = $purchaseData['invoice_no'];
			$vouchers->v_type = $purchaseData['sale_type'];
			$vouchers->debit = $sum;
			$vouchers->save();

		}
		// if(($purchaseData['sale_type']) =="Credit Sale"){
		// $ledgers = new Ledger();
		// $ledgers->sale_id = $purchaseData['id'];
		// $ledgers->party_id = $purchaseData['party_id'];
		// $ledgers->date = $purchaseData['due_date'];
		// $ledgers->particulars = $purchaseData['particulars'];
		// $ledgers->credit = $sum;
		// $ledgers->save();
		// }
		
		//return "inserted";
		return $purchaseData['id'];
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$newsale_detail = Sales::with(['sale_details'=>function($query){
								$query->with('products');
								//$query->with('taxes');
								//$query->with('discount');
								$query->with('parties');
								}])->with('billers')
								->where('sales.id', '=', $id)
								->get();
		$company_detail = Setting::where('id', '=', 1)->get();
		//return $newsale_detail;
		return view('sales.details', Compact('newsale_detail', 'company_detail'));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit($id)
    {
		$purchase = Sales::with(['sale_details'=>function($query){
		$query->with('products');
		$query->with('uoms');
		$query->with('discount');
		}])->with('parties')->where('sales.id', '=', $id)->get();
		//return $purchase;
		$DeliveryChallan = DeliveryChallan::where('status', '=', 'Pending')->OrderBy('dcn_no', 'asc')->pluck('dcn_no', 'dcn_no')->prepend('Select Challan', '0')->toArray();
		//$customer = Party::OrderBy('id', 'asc')->pluck('party_name', 'id');
		$edit = $purchase[0];
        //return $edit;
		$products = Product::select(DB::raw('CONCAT(`id`, "_", `product_name`) AS `id`, `product_name`'))->OrderBy('id', 'asc')->pluck('product_name', 'id')->prepend('Select Product', '0')->toArray();
		//$taxes = Tax::select(DB::raw('CONCAT(`id`, "_", `tax_rate`) AS `tax_rate`, `tax_title`'))->OrderBy('id', 'asc')->pluck('tax_title', 'tax_rate')->toArray();
		
		//$taxes = Tax::select(DB::raw('CONCAT(`id`, "_", `tax_rate`) AS `tax_rate`, `tax_title`'))->OrderBy('tax_title', 'asc')->pluck('tax_title', 'tax_rate')->prepend('Select Tax', '0.00')->toArray();
		$customers = Party::OrderBy('party_name', 'asc')->pluck('Party_name', 'id')->prepend('Select Customer', '0')->toArray();
		$customers = Party::join('account_groups', 'account_groups.id', '=', 'parties.account_group_id')
            ->where('parties.account_group_id', '=', '1')
            ->Orwhere('parties.account_group_id', '=', '8')
            ->OrderBy('party_name', 'asc')->pluck('party_name', 'parties.id');
		 $uoms = UOM::select(DB::raw('CONCAT(`id`, "_", `uom`) AS `id`, `uom`'))->OrderBy('id', 'asc')->pluck('uom', 'id')->toArray();
		 $discounts = Discount::select(DB::raw('CONCAT(`id`, "_", `discount`) AS `discount`, `title`'))->OrderBy('id', 'asc')->pluck('title', 'discount')->toArray();
		$encrypter = app('Illuminate\Encryption\Encrypter');
		$encrypted_token = $encrypter->encrypt(csrf_token());
        return view('sales.edit', Compact('edit', 'products', 'DeliveryChallan', 'customers', 'encrypted_token', 'uoms', 'discounts'));
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
		$objPurchase = Sales::findOrFail($id);
		$purchase = json_decode(Input::get('purchase'), true);
		$objPurchase->date = date('Y-m-d',strtotime($purchase['date']));
		$objPurchase->invoice_no = $purchase['invoice_no'];
		$objPurchase->localExport = $purchase['localExport'];
		$objPurchase->biller = $purchase['biller'];
		$objPurchase->sale_type = $purchase['sale_type'];
		$objPurchase->sale_list = $purchase['sale_list'];
		$objPurchase->sample_description = $purchase['sample_description'];
		$objPurchase->dcn_no = $purchase['dcn_no'];
		$objPurchase->party_id = $purchase['party_id'];
		$objPurchase->due_date = $purchase['due_date'];
		$objPurchase->particulars = $purchase['particulars'];
		//return $objPurchase;
		$objPurchase->save();

		SaleDetail::where('sale_id', '=', $id)->delete();
		GeneralVoucher::where('sale_id', '=', $id)->delete();
		LedgerDetailWise::where('sale_id', '=', $id)->delete();
		StockRegisterSpecificItem::where('sale_id', '=', $id)->delete();
		$products = Input::get('product_data');	
		$sum = 0;	
		foreach($products as $product)
		{
			$purchaseDetail = new SaleDetail();
			$purchaseDetail->sale_id = $objPurchase['id'];
			$purchaseDetail->product_id = $product['product_id'];
			$purchaseDetail->party_id = $product['party_id'];
			$purchaseDetail->uom_id = $product['uom_id'];
			$purchaseDetail->quantity = $product['quantity'];
			$purchaseDetail->product_cost = $product['product_cost'];
			$purchaseDetail->cost_amount = $product['cost_amount'];
			$purchaseDetail->discount_id = $product['discount_id'];
			$purchaseDetail->sale_rate = $product['sale_rate'];
			$purchaseDetail->sale_amount = $product['balance'];
			$sum = $sum + $product['balance'];			
			$purchaseDetail->save();

			$vouchers = new StockRegisterSpecificItem();
			$vouchers->sale_id = $objPurchase['id'];
			$vouchers->date = $objPurchase['date'];
			$vouchers->party_id = $product['party_id'];
			$vouchers->product_id = $product['product_id'];
			$vouchers->voucher_type = $objPurchase['sale_list'];
			$vouchers->sale_quantity = $product['quantity'];
			$vouchers->cost_rate = $product['balance'];
			$vouchers->save();

		if(($objPurchase['sale_type']) =="Cash Sale"){
			$vouchers = new LedgerDetailWise();
			$vouchers->sale_id = $objPurchase['id'];
			$vouchers->party_id = $product['party_id'];
			$vouchers->voucher_no = $objPurchase['invoice_no'];
			$vouchers->voucher_type = $objPurchase['sale_type'];
			$vouchers->date = $objPurchase['date'];
			$vouchers->product_id = $product['product_id'];
			$vouchers->quantity = $product['quantity'];
			$vouchers->rate = $product['sale_rate'];
			$vouchers->credit = $product['balance'];
			$vouchers->save();
		}
		if(($objPurchase['sale_type']) =="Credit Sale"){
			$vouchers = new LedgerDetailWise();
			$vouchers->sale_id = $objPurchase['id'];
			$vouchers->party_id = $product['party_id'];
			$vouchers->voucher_no = $objPurchase['invoice_no'];
			$vouchers->voucher_type = $objPurchase['sale_type'];
			$vouchers->date = $objPurchase['date'];
			$vouchers->product_id = $product['product_id'];
			$vouchers->quantity = $product['quantity'];
			$vouchers->rate = $product['sale_rate'];
			$vouchers->debit = $product['balance'];
			$vouchers->save();
		}

			// $vouchers = new LedgerDetailWise();
			// $vouchers->sale_id = $objPurchase['id'];
			// $vouchers->party_id = $product['party_id'];
			// $vouchers->voucher_no = $objPurchase['invoice_no'];
			// $vouchers->voucher_type = $objPurchase['sale_type'];
			// $vouchers->date = $objPurchase['date'];
			// $vouchers->product_id = $product['product_id'];
			// $vouchers->quantity = $product['quantity'];
			// $vouchers->rate = $product['sale_rate'];
			// $vouchers->debit = $product['balance'];
			// $vouchers->save();
		}

		if(($objPurchase['sale_type']) =="Cash Sale"){
			$vouchers = new GeneralVoucher();
			$vouchers->sale_id = $objPurchase['id'];
			$vouchers->account_head_id = $objPurchase['party_id'];
			$vouchers->date = $objPurchase['date'];
			$vouchers->voucher_no = $objPurchase['invoice_no'];
			$vouchers->v_type = $objPurchase['sale_type'];
			$vouchers->credit = $sum;
			$vouchers->save();

		}
		if(($objPurchase['sale_type']) =="Credit Sale"){
			$vouchers = new GeneralVoucher();
			$vouchers->sale_id = $objPurchase['id'];
			$vouchers->account_head_id = $objPurchase['party_id'];
			$vouchers->date = $objPurchase['date'];
			$vouchers->voucher_no = $objPurchase['invoice_no'];
			$vouchers->v_type = $objPurchase['sale_type'];
			$vouchers->debit = $sum;
			$vouchers->save();

		}
		return $objPurchase['id'];        
		//return "updated";        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $delete = Sales::findOrFail($id);
        $delete->delete();
        SaleDetail::where('sale_id', '=', $id)->delete(); 
        GeneralVoucher::where('sale_id', '=', $id)->delete(); 
        LedgerDetailWise::where('sale_id', '=', $id)->delete();
        StockRegisterSpecificItem::where('sale_id', '=', $id)->delete(); 

        // Ledger::where('sale_id', '=', $id)->delete();       
        return "Sale has been Deleted Successfully!";
    }
	
	public function purchase_json()
	{
		$productId = Input::get('purchase_id');
		return "Jallo3";
		$productsArray = Product::where('id', '=', $productId)->get(['products.product_cost AS product_newcost']);
		return $productsArray;
	}
	
	public function unit_price()
	{
		$productId = Input::get('ProductID');
		return "Jallo";
		$productsArray = Product::where('id', '=', $productId)->get();
		return $productsArray;
	}
	
	public function FirstProduct()
	{
	$productId = Input::get('saletab_id');
	$productArray = Product::where('product_code', '=', $productId)->get(['products.*']);
	return $productArray;
	}
	
	public function getProduct()
	{
	$productCode = Input::get('code_id');
	$data = Product::join('purchase_details', 'purchase_details.product_id', '=', 'products.id')
		->where('product_code', '=', $productCode)
		->where('remaining_quantity', '!=', 0)
		->OrderBy('purchase_details.id', 'asc')
		->first(['products.*','purchase_details.remaining_quantity', 'purchase_details.unit_cost', 'purchase_details.total_cost']);
		//->first();
	$test[] = $data;;
	return $test;
	}

	 public function ProductChange()
    {
        $productID = Input::get('prodID');
        $test = Product::where('id', '=', $productID)->get(['products.*']);
   //        $data = Product::join('purchase_details', 'purchase_details.product_id', '=', 'products.id')
	  // 	->where('products.id', '=', $productID)
	  // 	->where('remaining_quantity', '!=', 0)
	  // 	->OrderBy('purchase_details.id', 'asc')
	  // 	->first(['products.*','purchase_details.remaining_quantity', 'purchase_details.unit_cost', 'purchase_details.total_cost']);
	  // $test[] = $data;
	return $test;
    }
	
	public function PartyChange(){
    	$partyname = Input::get('party_id');
    	$data = Party::where('id', '=', $partyname)->get();
    	return $data;
    }

	public function print_sale($id)
    {
		$newsale_detail = Sales::with(['sale_details'=>function($query){
								$query->with('uoms');
								$query->with(['products'=>function($query){
								$query->with('publishers');
								}]);
								$query->with('taxes');
								$query->with('discount');
								$query->with('ledger');
								//$query->with('publishers');
						}])->with('parties')->with('billers')
						->where('sales.id', '=', $id)
						->get();
		//return $newsale_detail;
		//return $id;
		
		$ledgers = GeneralVoucher::where('account_head_id', '=', $newsale_detail[0]->parties->id)->get();
		//return $ledgers;
		$logo = SystemLogo::where('id', '=', 1)->get();
		$company_detail = Setting::where('id', '=', 1)->get();
		

		return view('sales.print', Compact('newsale_detail', 'company_detail', 'ledgers', 'logo', 'ledgers'));
	}

	 public function getOrderPDF($id){
    $newsale_detail = Sales::with(['sale_details'=>function($query){
								$query->with('uoms');
								$query->with(['products'=>function($query){
								//$query->with('publishers');
								}]);
								//$query->with('taxes');
								$query->with('discount');
								//$query->with('ledger');
								//$query->with('publishers');
						}])->with('parties')->with('billers')
						->where('sales.id', '=', $id)
						->get();
	//$newsale_detail = $dos->chunk(20);
	//$newsale_detail = $data[0];
    //return $newsale_detail;
    $company_detail = Setting::where('id', '=', 1)->get();
    $pdf = PDF::loadView('sales.printpdf', ['newsale_detail' => $newsale_detail, 'company_detail' => $company_detail]);
    //$pdf = PDF::loadView('sales.printpdf', compact('newsale_detail','company_detail'))->setPaper('A4')->stream();
    return $pdf->download('salebill.pdf');
    }

	public function DCMouseUp()
    {
        $DC_No = Input::get('dc_no');
        //return $DC_No;
        $purchases = DeliveryChallanDetail::join('delivery_challans', 'delivery_challans.id', '=', 'delivery_challan_details.challan_id')
            ->join('products', 'products.id', '=', 'delivery_challan_details.product_id')
            ->join('parties', 'parties.id', 'delivery_challans.party_id')
            //->join('taxes', 'taxes.id', '=', 'grn_details.tax_id')
            ->where('delivery_challans.dcn_no', '=', $DC_No)->get();
        return $purchases;
    }



}
