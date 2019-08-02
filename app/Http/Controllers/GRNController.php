<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Product;
use App\Stock;
use App\SystemLogo;
use App\GRN;
use App\GRNDetails;
use App\Tax;
use App\SupplierLedgers;
use App\Party;
use App\StockRegisterSpecificItem;
use App\LedgerDetailWise;
use App\UOM;
use Illuminate\Support\Facades\Input;
use DB;
use Carbon\Carbon;
class GRNController extends Controller
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
    // $purchases = GRN::with(['grn_details'=>function($query){
    //                         $query->with('purchase_tax');
    //                         }])->with('suppliers')->OrderBy('grns.id', 'desc')->get();
    $purchases = GRN::with('grn_details')->with('parties')->OrderBy('grns.id', 'desc')->get();
    //return $purchases;
    //$purchases = $produsts[0];
    return view('grn.index', Compact('purchases'));
    }

     public function print_grn($id)
    {
    $detail = GRN::with(['grn_details'=>function($query){
                            //$query->with('purchase_tax');
                            $query->with('products');
                            }])->with('parties')->where('grns.id', '=', $id)->get();
        //return $detail;
        $purchase_detail = $detail[0];
        //return $purchase_detail;
        return view('grn.print', Compact('purchase_detail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $code = GRN::OrderBy('id', 'asc')->get();
        $codes = $code->last()->grn_no + 1;
     $products = Product::OrderBy('product_name', 'asc')->pluck('product_name', 'product_name')->prepend('Select Product', '0')->toArray();
        $taxes = Tax::select(DB::raw('CONCAT(`id`, "_", `tax_rate`) AS `tax_rate`, `tax_title`'))->OrderBy('id', 'asc')->pluck('tax_title', 'tax_rate')->toArray();
        //$supplier = Supplier::OrderBy('id', 'asc')->pluck('name', 'id');
        // $suppliers = Party::where('type', 'Buyer')->OrderBy('party_name', 'asc')->pluck('party_name', 'id')->prepend('Select Account', '0');
        $suppliers = Party::join('account_groups', 'account_groups.id', '=', 'parties.account_group_id')
            ->where('parties.account_group_id', '=', '2')
            ->OrderBy('party_name', 'asc')->pluck('party_name', 'parties.id')->prepend('Select Account', '0');
        
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
        //$uoms = UOM::OrderBy('id', 'asc')->pluck('uom', 'uom');
        $uoms = UOM::select(DB::raw('CONCAT(`id`, "_", `uom`) AS `id`, `uom`'))->OrderBy('id', 'asc')->pluck('uom', 'id')->toArray();
        return view('grn.create', Compact('suppliers', 'products', 'codes', 'taxes', 'encrypted_token', 'uoms'));
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
        $purchase = json_decode(Input::get('grn'), true);
        $purchase['date'] = date('Y-m-d',strtotime($purchase['date']));
        $products = Input::get('details_data'); 
        //return $products;       
        $purchaseData = GRN::create($purchase);
        $sum = "0";
        foreach($products as $product)
        {
          
            $purchaseDetail = new GRNDetails();
            $purchaseDetail->grn_id = $purchaseData['id'];
            $purchaseDetail->product_id = $product['product_id'];
            $purchaseDetail->uom_id = $product['uom_id'];
            $purchaseDetail->quantity = $product['quantity'];
            $purchaseDetail->rate = $product['rate'];
            $purchaseDetail->amount = $product['amount'];
            $sum = $sum + $product['amount'];
            $purchaseDetail->save();

            // $vouchers = new LedgerDetailWise();
            // $vouchers->purchase_id = $purchaseData['id'];
            // $vouchers->party_id = $purchaseData['account_id'];
            // $vouchers->voucher_no = $purchaseData['grn_no'];
            // $vouchers->voucher_type = "GRN";
            // $vouchers->date = $purchaseData['date'];
            // $vouchers->product_id = $product['product_id'];
            // $vouchers->quantity = $product['quantity'];
            // $vouchers->rate = $product['rate'];
            // $vouchers->debit = $product['amount'];
            // $vouchers->save();

            $vouchers = new StockRegisterSpecificItem();
            $vouchers->grn_id = $purchaseData['id'];
            $vouchers->date = $purchaseData['date'];
            $vouchers->party_id = $purchaseData['account_id'];
            $vouchers->product_id = $product['product_id'];
            $vouchers->voucher_type = "GRN";
            $vouchers->purchase_quantity = $product['quantity'];
            $vouchers->cost_rate = $product['amount'];
            $vouchers->save();
        }
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
        $purchase = GRN::with(['grn_details'=>function($query){
        $query->with('products');
        $query->with('unit');
        }])->with('parties')->where('grns.id', '=', $id)->get();
        $suppliers = Party::OrderBy('party_name', 'asc')->pluck('party_name', 'id');
        $products = Product::OrderBy('product_name', 'asc')->pluck('product_name', 'product_name')->prepend('Select Product', '0')->toArray();
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
        $edit = $purchase[0];
        $uoms = UOM::select(DB::raw('CONCAT(`id`, "_", `uom`) AS `id`, `uom`'))->OrderBy('id', 'asc')->pluck('uom', 'id')->toArray();
        return view('grn.edit', Compact('edit', 'products', 'suppliers', 'products', 'encrypted_token', 'uoms'));
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
        $objPurchase = GRN::findOrFail($id);
        $purchase = json_decode(Input::get('grn'), true);
        $objPurchase->account_id = $purchase['account_id'];
        //$purchase['date'] = date('Y-m-d',strtotime($purchase['date']));
        $objPurchase->date = date('Y-m-d',strtotime($purchase['date']));
        $objPurchase->grn_no = $purchase['grn_no'];
        $objPurchase->status = $purchase['status'];
        $objPurchase->save();

        GRNDetails::where('grn_id', '=', $id)->delete();
        StockRegisterSpecificItem::where('grn_id', '=', $id)->delete();
        $products = Input::get('details_data');
        $sum = "0";
        foreach($products as $product)
        {
            $purchaseDetail = new GRNDetails();
            $purchaseDetail->grn_id = $objPurchase['id'];
            $purchaseDetail->product_id = $product['product_id'];
            $purchaseDetail->uom_id = $product['uom_id'];
            $purchaseDetail->quantity = $product['quantity'];
            $purchaseDetail->rate = $product['rate'];
            $purchaseDetail->amount = $product['amount'];
            $sum = $sum + $product['amount'];
            $purchaseDetail->save();

            $vouchers = new StockRegisterSpecificItem();
            $vouchers->grn_id = $objPurchase['id'];
            $vouchers->date = $objPurchase['date'];
            $vouchers->party_id = $objPurchase['account_id'];
            $vouchers->product_id = $product['product_id'];
            $vouchers->voucher_type = "GRN";
            $vouchers->purchase_quantity = $product['quantity'];
            $vouchers->cost_rate = $product['amount'];
            $vouchers->save();
        }
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
    $delete = GRN::findOrFail($id);
    $delete->delete();
     GRNDetails::where('grn_id', '=', $id)->delete();
     StockRegisterSpecificItem::where('grn_id', '=', $id)->delete();
     return "GRN Deleted successfully!";
    }

        public function ProductKeyUp()
    {
        $productName = Input::get('product_name');
         $productsArray = Product::where('product_name', '=', $productName)->get(['products.*']);
        return $productsArray;
    }




}
