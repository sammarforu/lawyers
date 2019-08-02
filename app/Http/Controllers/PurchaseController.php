<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Tax;
use App\Stock;
use App\SystemLogo;
use App\Purchase;
use App\PurchaseDetail;
use App\SupplierLedgers;
use App\GRN;
use App\GRNDetails;
use App\Party;
use App\GeneralVoucher;
use App\Supplier;
use App\StockRegisterSpecificItem;
use App\LedgerDetailWise;
use App\UOM;
use App\Warehouse;
use Illuminate\Support\Facades\Input;
use DB;
use Excel;
use Session;
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
							}])->with('parties')->OrderBy('purchases.id', 'desc')->get();
	//return $purchases;
	return view('purchases.index', Compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$code = Purchase::OrderBy('id', 'asc')->get();
		$codes = $code->last()->bill_no + 1;

		$grns = GRN::where('status', '=', 'Pending')->OrderBy('grn_no', 'asc')->pluck('grn_no', 'grn_no')->prepend('Select Grn', '0')->toArray();
		//return $grns;
		// $products = Product::OrderBy('product_name', 'asc')->pluck('product_name', 'product_name')->prepend('Select Product', '0')->toArray();
		$products = Product::select(DB::raw('CONCAT(`id`, "_", `product_name`) AS `id`, `product_name`'))->OrderBy('id', 'asc')->pluck('product_name', 'id')->prepend('Select Product', '0')->toArray();
		$taxes = Tax::select(DB::raw('CONCAT(`id`, "_", `tax_rate`) AS `tax_rate`, `tax_title`'))->OrderBy('id', 'asc')->pluck('tax_title', 'tax_rate')->toArray();
		//$suppliers = Supplier::OrderBy('id', 'asc')->pluck('name', 'id');
		$Account = Party::join('account_groups', 'account_groups.id', '=', 'parties.account_group_id')
            ->where('parties.account_group_id', '=', '2')
            ->Orwhere('parties.account_group_id', '=', '8')
            ->OrderBy('party_name', 'asc')->pluck('party_name', 'parties.id')->prepend('Select Account', '0');
		$warehouse = Warehouse::OrderBy('name', 'asc')->pluck('name', 'id')->toArray();
		$encrypter = app('Illuminate\Encryption\Encrypter');
		$encrypted_token = $encrypter->encrypt(csrf_token());
		$uoms = UOM::select(DB::raw('CONCAT(`id`, "_", `uom`) AS `id`, `uom`'))->OrderBy('id', 'asc')->pluck('uom', 'id')->prepend('PCS', '2_PCS')->toArray();
        return view('purchases.create', Compact('Account', 'products', 'codes', 'taxes', 'grns', 'encrypted_token', 'uoms', 'warehouse'));
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
		$purchaseData = Purchase::create($purchase);
		// if($purchaseData->grn_no != 	"0"){
		// $project = GRN::where("grn_no", $purchaseData->grn_no)->first();
		// $project->status = "Added";
		// $project->save();
		// }	
		$sum = "0";
		foreach($products as $product)
		{
			$purchaseDetail = new PurchaseDetail();
			$purchaseDetail->purchase_id = $purchaseData['id'];
			$purchaseDetail->party_id = $purchaseData['account_id'];
			$purchaseDetail->product_id = $product['product_id'];
			$purchaseDetail->uom_id = $product['uom_id'];
			$purchaseDetail->warehouse_id = $purchaseData['warehouse_id'];
			$purchaseDetail->quantity = $product['quantity'];
			$purchaseDetail->remaining_quantity = $product['quantity'];
			$purchaseDetail->unit_cost = $product['unit_cost'];
			$purchaseDetail->expiry = $product['expiry'];
			$purchaseDetail->total_cost = $product['total_cost'];
			$sum = $sum + $product['total_cost'];
			$purchaseDetail->save();

	 		$vouchers = new LedgerDetailWise();
			 $vouchers->purchase_id = $purchaseData['id'];
			 $vouchers->party_id = $purchaseData['account_id'];
			 $vouchers->voucher_no = $purchaseData['bill_no'];
			 $vouchers->voucher_type = $purchaseData['purchase_type'];
			 $vouchers->date = $purchaseData['date'];
			 $vouchers->product_id = $product['product_id'];
			 $vouchers->quantity = $product['quantity'];
			 $vouchers->rate = $product['unit_cost'];
			 $vouchers->credit = $product['total_cost'];
			 $vouchers->save();

			  $vouchers = new StockRegisterSpecificItem();
			  $vouchers->purchase_id = $purchaseData['id'];
			  $vouchers->date = $purchaseData['date'];
			  $vouchers->party_id = $purchaseData['account_id'];
			  $vouchers->product_id = $product['product_id'];
			  $vouchers->voucher_type = $purchaseData['purchase_type'];
			  $vouchers->purchase_quantity = $product['quantity'];
			  $vouchers->cost_rate = $product['total_cost'];
			  $vouchers->save();
		}
		    $vouchers = new GeneralVoucher();
			$vouchers->purchase_id = $purchaseData['id'];
			$vouchers->account_head_id = $purchaseData['account_id'];
			$vouchers->date = $purchaseData['date'];
			$vouchers->voucher_no = $purchaseData['bill_no'];
			$vouchers->v_type = $purchaseData['purchase_type'];
			$vouchers->credit = $sum;
			$vouchers->save();

		// if(($purchaseData['purchase_type']) =="Credit Purchase"){
		//  $ledgers = new SupplierLedgers();
		//  $ledgers->supplier_id = $purchaseData['supplier_id'];
		//  $ledgers->date = $purchaseData['due_date'];
		//  $ledgers->particulars = $purchaseData['particulars'];
		// $ledgers->credit = $sum;
		// $ledgers->save();
		// }
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
									$query->with('products');
									$query->with('unit');
							}])->where('purchases.id', '=', $id)->get();
		$edit = $purchase[0];
		$grns = GRN::OrderBy('grn_no', 'asc')->pluck('grn_no', 'grn_no')->prepend('Select Grn', '0')->toArray();
        $products = Product::OrderBy('product_name', 'asc')->pluck('product_name', 'product_name')->prepend('Select Product', '0')->toArray();
		$taxes = Tax::select(DB::raw('CONCAT(`id`, "_", `tax_rate`) AS `tax_rate`, `tax_title`'))->OrderBy('tax_title', 'asc')->pluck('tax_title', 'tax_rate')->prepend('Select Tax', '0.00')->toArray();
		//$suppliers =Party::where('type', 'Buyer')->OrderBy('party_name', 'asc')->pluck('party_name', 'id');
		//$Account = Party::OrderBy('party_name', 'asc')->pluck('party_name', 'id')->prepend('Select Account', '0');
		$Account = Party::join('account_groups', 'account_groups.id', '=', 'parties.account_group_id')
            ->where('parties.account_group_id', '=', '2')
            ->Orwhere('parties.account_group_id', '=', '8')
            ->OrderBy('party_name', 'asc')->pluck('party_name', 'parties.id');
		$encrypter = app('Illuminate\Encryption\Encrypter');
		$encrypted_token = $encrypter->encrypt(csrf_token());
		//return $edit;
		$uoms = UOM::select(DB::raw('CONCAT(`id`, "_", `uom`) AS `id`, `uom`'))->OrderBy('id', 'asc')->pluck('uom', 'id')->toArray();
        return view('purchases.edit', Compact('edit', 'products', 'taxes' , 'Account', 'grns', 'encrypted_token', 'uoms'));
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
		$objPurchase->account_id = $purchase['account_id'];
		$objPurchase->date = date('Y-m-d',strtotime($purchase['date']));
		$objPurchase->bill_no = $purchase['bill_no'];
		$objPurchase->grn_no = $purchase['grn_no'];
		$objPurchase->purchase_type = $purchase['purchase_type'];
		$objPurchase->due_date = $purchase['due_date'];
		$objPurchase->particulars = $purchase['particulars'];
		$objPurchase->save();
		
		PurchaseDetail::where('purchase_id', '=', $id)->delete();
		StockRegisterSpecificItem::where('purchase_id', '=', $id)->delete();
		LedgerDetailWise::where('purchase_id', '=', $id)->delete();
		GeneralVoucher::where('purchase_id', '=', $id)->delete();
		$products = Input::get('product_data');	
		$sum = "0";	
		foreach($products as $product)
		{
			$purchaseDetail = new PurchaseDetail();
			$purchaseDetail->purchase_id = $objPurchase['id'];
			$purchaseDetail->party_id = $objPurchase['account_id'];
			$purchaseDetail->product_id = $product['product_id'];
			$purchaseDetail->uom_id = $product['uom_id'];
			$purchaseDetail->quantity = $product['quantity'];
			$purchaseDetail->remaining_quantity = $product['quantity'];
			$purchaseDetail->unit_cost = $product['unit_cost'];
			$purchaseDetail->total_cost = $product['total_cost'];
			$sum = $sum + $product['total_cost'];
			$purchaseDetail->save();

			 $vouchers = new LedgerDetailWise();
			 $vouchers->purchase_id = $objPurchase['id'];
			 $vouchers->party_id = $objPurchase['account_id'];
			 $vouchers->voucher_no = $objPurchase['bill_no'];
			 $vouchers->voucher_type = $objPurchase['purchase_type'];
			 $vouchers->date = $objPurchase['date'];
			 $vouchers->product_id = $product['product_id'];
			 $vouchers->quantity = $product['quantity'];
			 $vouchers->rate = $product['unit_cost'];
			 $vouchers->credit = $product['total_cost'];
			 $vouchers->save();

			 $vouchers = new StockRegisterSpecificItem();
			 $vouchers->purchase_id = $objPurchase['id'];
			 $vouchers->date = $objPurchase['date'];
			 $vouchers->party_id = $objPurchase['account_id'];
			 $vouchers->product_id = $product['product_id'];
			 $vouchers->voucher_type = $objPurchase['purchase_type'];
			 $vouchers->purchase_quantity = $product['quantity'];
			 $vouchers->cost_rate = $product['total_cost'];
			 $vouchers->save();
		}
			 $vouchers = new GeneralVoucher();
			 $vouchers->purchase_id = $objPurchase['id'];
			 $vouchers->account_head_id = $objPurchase['account_id'];
			 $vouchers->date = $objPurchase['date'];
			 $vouchers->voucher_no = $objPurchase['bill_no'];
			 $vouchers->v_type = $objPurchase['purchase_type'];
			 $vouchers->credit = $sum;
			 $vouchers->save();
		return $objPurchase['id'];        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $delete = Purchase::findOrFail($id);
        $delete->delete();
        PurchaseDetail::where('purchase_id', '=', $id)->delete(); 
        GeneralVoucher::where('purchase_id', '=', $id)->delete(); 
        LedgerDetailWise::where('purchase_id', '=', $id)->delete();
        // Ledger::where('sale_id', '=', $id)->delete();       
        return "Purchase has been Deleted Successfully!"; 
    }

    public function codeMouseUp()
	{
		$productId = Input::get('entered_code');
		//return $productId;
		$productsArray = Product::where('product_code', '=', $productId)->get(['products.*']);
		return $productsArray;
	}

		public function ProductKeyUp()
	{
		$productID = Input::get('product_ID');
		 $productsArray = Product::where('id', '=', $productID)->get(['products.*']);
		//$productsArray = Product::where('product_name', 'like', '%'.$productName.'%')->get(['products.*']);
		return $productsArray;
	}
	
	public function print_purchase($id)
	{
	$logo = SystemLogo::where('id', '=', 1)->get();
	$detail = Purchase::with(['purchase_details'=>function($query){
							$query->with('unit');
							$query->with('purchase_tax');
							$query->with('products');
							}])->with('parties')->where('purchases.id', '=', $id)->get();
		//return $detail;
		$purchase_detail = $detail[0];
		//return $purchase_detail;
		return view('purchases.print', Compact('purchase_detail', 'logo'));
	}

	    public function grnMouseUp()
    {
        $grnNo = Input::get('grn_no');
        $purchases = GRNDetails::join('grns', 'grns.id', '=', 'grn_details.grn_id')
            ->join('products', 'products.id', '=', 'grn_details.product_id')
            ->join('parties', 'parties.id', '=', 'grns.account_id')
            //->join('taxes', 'taxes.id', '=', 'grn_details.tax_id')
            ->where('grns.grn_no', '=', $grnNo)->get();
        return $purchases;
    }

      public function ImportExcel(Request $request)
    {
        $this->validate($request, [
            'import_file' => 'required'
        ]);
        $path = $request->file('import_file')->getRealPath();
        $results = Excel::load($path)->get();
        //return $results;
        if(!empty($results) && $results->count()){
        foreach ($results as $row) {
          //foreach ($rows as $row) {
            if (($row->product_name)!=null){
          PurchaseDetail::create([
                'purchase_id'  => $row->purchase_id,
                'party_id'  => $row->party_id,
                'product_id'  => $row->product_id,
                'uom_id'  => $row->uom_id,
                'warehouse_id'  => $row->warehouse_id,
                'quantity'  => $row->quantity,
                'remaining_quantity'  => $row->remaining_quantity,
                'unit_cost'  => $row->unit_cost,
                'expiry'  => $row->expiry,
                'total_cost'  => $row->total_cost,
                ]);
              }
            //}
          }
      }

    Session::flash('flash_message', 'Stock Sheet Imported Successfully!');
        return redirect('purchases/import-stock/create');
    }
    

    public function createImportExcel()
    {
        return view('purchases.import-stock.create');
    }
}
