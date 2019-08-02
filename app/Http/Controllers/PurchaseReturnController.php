<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Tax;
use App\Stock;
use App\SystemLogo;
use App\PurchaseReturn;
use App\PurchaseReturnDetails;
use App\SupplierLedgers;
use App\GRN;
use App\UOM;
use App\GRNDetails;
use App\Party;
use App\GeneralVoucher;
use App\Supplier;
use App\StockRegisterSpecificItem;
use App\LedgerDetailWise;
use Illuminate\Support\Facades\Input;
use DB;
use Carbon\Carbon;
class PurchaseReturnController extends Controller
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
    $purchases = PurchaseReturn::with(['purchase_return_detail'=>function($query){
                            $query->with('purchase_tax');
                            }])->with('parties')->OrderBy('purchase_returns.id', 'desc')->get();
    //return $purchases;
    return view('purchase-return.index', Compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $code = PurchaseReturn::OrderBy('id', 'asc')->get();
        $codes = $code->last()->bill_no + 1;

        $grns = GRN::where('status', '=', 'Pending')->OrderBy('grn_no', 'asc')->pluck('grn_no', 'grn_no')->prepend('Select Grn', '0')->toArray();
        //return $grns;
        $products = Product::select(DB::raw('CONCAT(`id`, "_", `product_name`) AS `id`, `product_name`'))->OrderBy('id', 'asc')->pluck('product_name', 'id')->prepend('Select Product', '0')->toArray();
        $taxes = Tax::select(DB::raw('CONCAT(`id`, "_", `tax_rate`) AS `tax_rate`, `tax_title`'))->OrderBy('id', 'asc')->pluck('tax_title', 'tax_rate')->toArray();
        //$suppliers = Supplier::OrderBy('id', 'asc')->pluck('name', 'id');
        $Account = Party::join('account_groups', 'account_groups.id', '=', 'parties.account_group_id')
            ->where('parties.account_group_id', '=', '2')->OrderBy('party_name', 'asc')->pluck('party_name', 'parties.id')->prepend('Select Account', '0');
        $uoms = UOM::select(DB::raw('CONCAT(`id`, "_", `uom`) AS `id`, `uom`'))->OrderBy('id', 'asc')->pluck('uom', 'id')->toArray();
        
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
        
        return view('purchase-return.create', Compact('Account', 'products', 'codes', 'taxes', 'grns', 'uoms', 'encrypted_token'));
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
        $purchaseData = PurchaseReturn::create($purchase);
        if($purchaseData->grn_no !=     "0"){
        $project = GRN::where("grn_no", $purchaseData->grn_no)->first();
        $project->status = "Added";
        $project->save();
        }   
        $sum = "0";
        foreach($products as $product)
        {
            $purchaseDetail = new PurchaseReturnDetails();
            $purchaseDetail->purchase_id = $purchaseData['id'];
            $purchaseDetail->party_id = $purchaseData['account_id'];
            $purchaseDetail->product_id = $product['product_id'];
            $purchaseDetail->uom_id = $product['uom_id'];
            $purchaseDetail->quantity = $product['quantity'];
            $purchaseDetail->remaining_quantity = $product['quantity'];
            $purchaseDetail->unit_cost = $product['unit_cost'];
            $purchaseDetail->total_cost = $product['total_cost'];
            $sum = $sum + $product['total_cost'];
            $purchaseDetail->save();

            $vouchers = new LedgerDetailWise();
             $vouchers->purchase_ret_id = $purchaseData['id'];
             $vouchers->party_id = $purchaseData['account_id'];
             $vouchers->voucher_no = $purchaseData['bill_no'];
             $vouchers->voucher_type = $purchaseData['purchase_type'];
             $vouchers->date = $purchaseData['date'];
             $vouchers->product_id = $product['product_id'];
             $vouchers->quantity = $product['quantity'];
             $vouchers->rate = $product['unit_cost'];
             $vouchers->debit = $product['total_cost'];
             $vouchers->save();

              $vouchers = new StockRegisterSpecificItem();
              $vouchers->purchase_ret_id = $purchaseData['id'];
              $vouchers->date = $purchaseData['date'];
              $vouchers->party_id = $purchaseData['account_id'];
              $vouchers->product_id = $product['product_id'];
              $vouchers->voucher_type = $purchaseData['purchase_type'];
              $vouchers->pur_ret_quantity = $product['quantity'];
              $vouchers->cost_rate = $product['total_cost'];
              $vouchers->save();
        }
            $vouchers = new GeneralVoucher();
            $vouchers->purchase_ret_id = $purchaseData['id'];
            $vouchers->account_head_id = $purchaseData['account_id'];
            $vouchers->date = $purchaseData['date'];
            $vouchers->voucher_no = $purchaseData['bill_no'];
            $vouchers->v_type = $purchaseData['purchase_type'];
            $vouchers->debit = $sum;
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
    $purchase = PurchaseReturn::with(['purchase_return_detail'=>function($query){
                                    $query->with('purchase_tax');
                                    $query->with('products');
                                    $query->with('unit');
                            }])->where('purchase_returns.id', '=', $id)->get();
        $edit = $purchase[0];
        $grns = GRN::OrderBy('grn_no', 'asc')->pluck('grn_no', 'grn_no')->prepend('Select Grn', '0')->toArray();
        $products = Product::OrderBy('product_name', 'asc')->pluck('product_name', 'product_name')->prepend('Select Product', '0')->toArray();
        $taxes = Tax::select(DB::raw('CONCAT(`id`, "_", `tax_rate`) AS `tax_rate`, `tax_title`'))->OrderBy('tax_title', 'asc')->pluck('tax_title', 'tax_rate')->prepend('Select Tax', '0.00')->toArray();
        //$suppliers =Party::where('type', 'Buyer')->OrderBy('party_name', 'asc')->pluck('party_name', 'id');
        $Account = Party::OrderBy('party_name', 'asc')->pluck('party_name', 'id')->prepend('Select Account', '0');
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
        $uoms = UOM::select(DB::raw('CONCAT(`id`, "_", `uom`) AS `id`, `uom`'))->OrderBy('id', 'asc')->pluck('uom', 'id')->toArray();
        //return $edit;
        return view('purchase-return.edit', Compact('edit', 'products', 'taxes' , 'Account', 'grns', 'encrypted_token', 'uoms'));
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
    $objPurchase = PurchaseReturn::findOrFail($id);
        $purchase = json_decode(Input::get('purchase'), true);
        $objPurchase->account_id = $purchase['account_id'];
        $objPurchase->date = date('Y-m-d',strtotime($purchase['date']));
        $objPurchase->bill_no = $purchase['bill_no'];
        $objPurchase->grn_no = $purchase['grn_no'];
        $objPurchase->purchase_type = $purchase['purchase_type'];
        $objPurchase->due_date = $purchase['due_date'];
        $objPurchase->particulars = $purchase['particulars'];
        $objPurchase->save();
        PurchaseReturnDetails::where('purchase_id', '=', $id)->delete();
        LedgerDetailWise::where('purchase_ret_id', '=', $id)->delete();
        GeneralVoucher::where('purchase_ret_id', '=', $id)->delete(); 
        StockRegisterSpecificItem::where('purchase_ret_id', '=', $id)->delete();
        $products = Input::get('product_data'); 
        $sum = "0"; 
        foreach($products as $product)
        {
            $purchaseDetail = new PurchaseReturnDetails();
            $purchaseDetail->purchase_id = $objPurchase['id'];
            $purchaseDetail->product_id = $product['product_id'];
            $purchaseDetail->uom_id = $product['uom_id'];
            $purchaseDetail->quantity = $product['quantity'];
            $purchaseDetail->remaining_quantity = $product['quantity'];
            $purchaseDetail->unit_cost = $product['unit_cost'];
            $purchaseDetail->total_cost = $product['total_cost'];
            $sum = $sum + $product['total_cost'];
            $purchaseDetail->save();

             $vouchers = new LedgerDetailWise();
             $vouchers->purchase_ret_id = $objPurchase['id'];
             $vouchers->party_id = $objPurchase['account_id'];
             $vouchers->voucher_no = $objPurchase['bill_no'];
             $vouchers->voucher_type = $objPurchase['purchase_type'];
             $vouchers->date = $objPurchase['date'];
             $vouchers->product_id = $product['product_id'];
             $vouchers->quantity = $product['quantity'];
             $vouchers->rate = $product['unit_cost'];
             $vouchers->debit = $product['total_cost'];
             $vouchers->save();

             $vouchers = new StockRegisterSpecificItem();
             $vouchers->purchase_id = $objPurchase['id'];
             $vouchers->date = $objPurchase['date'];
             $vouchers->party_id = $objPurchase['account_id'];
             $vouchers->product_id = $product['product_id'];
             $vouchers->voucher_type = $objPurchase['purchase_type'];
             $vouchers->pur_ret_quantity = $product['quantity'];
             $vouchers->cost_rate = $product['total_cost'];
             $vouchers->save();
        }
            $vouchers = new GeneralVoucher();
            $vouchers->purchase_ret_id = $objPurchase['id'];
            $vouchers->account_head_id = $objPurchase['account_id'];
            $vouchers->date = $objPurchase['date'];
            $vouchers->voucher_no = $objPurchase['bill_no'];
            $vouchers->v_type = $objPurchase['purchase_type'];
            $vouchers->debit = $sum;
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
    $delete = PurchaseReturn::findOrFail($id);
        $delete->delete();
        PurchaseReturnDetails::where('purchase_id', '=', $id)->delete(); 
        GeneralVoucher::where('purchase_ret_id', '=', $id)->delete(); 
        LedgerDetailWise::where('purchase_ret_id', '=', $id)->delete();
        StockRegisterSpecificItem::where('purchase_ret_id', '=', $id)->delete(); 
        // Ledger::where('sale_id', '=', $id)->delete();       
        return "Purchase has been Deleted Successfully!"; 
    }

    public function print_purchase($id)
    {
    $logo = SystemLogo::where('id', '=', 1)->get();
    $detail = PurchaseReturn::with(['purchase_return_detail'=>function($query){
                            $query->with('unit');
                            $query->with('purchase_tax');
                            $query->with('products');
                            }])->with('parties')->where('purchase_returns.id', '=', $id)->get();
        //return $detail;
        $purchase_detail = $detail[0];
        //return $purchase_detail;
        return view('purchase-return.print', Compact('purchase_detail', 'logo'));
    }
}
