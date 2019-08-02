<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Product;
use App\Party;
use App\Supplier;
use App\DeliveryChallan;
use App\DeliveryChallanDetail;    
use App\PurchaseDetail;    
use App\StockRegisterSpecificItem;    
use App\LedgerDetailWise;    
use App\SystemLogo;    
use App\UOM;    
use DB;    
class DeliveryChallanController extends Controller
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
     $purchases = DeliveryChallan::with('challan_details')->with('parties')->OrderBy('delivery_challans.id', 'desc')->get();
     //return $purchases;
    //$purchases = $produsts[0];
    return view('delivery-challan.index', Compact('purchases'));
    }

    public function print_challan($id)
    {
        $detail = DeliveryChallan::with('parties')->with(['challan_details'=>function($query){
                            // $query->with('purchase_tax');
                            $query->with('products');
                            }])->where('delivery_challans.id', '=', $id)->get();
        //return $detail;
        $purchase_detail = $detail[0];
        $logo = SystemLogo::where('id', '=', 1)->get();
        //return $purchase_detail;
        return view('delivery-challan.print', Compact('purchase_detail', 'logo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $code = DeliveryChallan::OrderBy('id', 'asc')->get();
        $codes = $code->last()->dcn_no + 1;
    //$products = Product::OrderBy('product_name', 'asc')->pluck('product_name', 'id')->prepend('Select Product', '0')->toArray();
        // $taxes = Tax::select(DB::raw('CONCAT(`id`, "_", `tax_rate`) AS `tax_rate`, `tax_title`'))->OrderBy('id', 'asc')->pluck('tax_title', 'tax_rate')->toArray();
     $products = Product::select(DB::raw('CONCAT(`id`, "_", `product_name`) AS `id`, `product_name`'))->OrderBy('id', 'asc')->pluck('product_name', 'id')->prepend("Select Product")->toArray();
        $parties = Party::where('account_type', 'Client')->OrderBy('party_name', 'asc')->pluck('party_name', 'id');
        $uoms = UOM::select(DB::raw('CONCAT(`id`, "_", `uom`) AS `id`, `uom`'))->OrderBy('id', 'asc')->pluck('uom', 'id')->toArray();
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
        
        return view('delivery-challan.create', Compact('parties', 'products', 'taxes', 'codes', 'uoms', 'encrypted_token'));
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
        $purchaseData = DeliveryChallan::create($purchase);
        $sum = "0";
        foreach($products as $product)

        {
            $purchaseDetail = new DeliveryChallanDetail();
            $purchaseDetail->challan_id = $purchaseData['id'];
            $purchaseDetail->product_id = $product['product_id'];
            $purchaseDetail->uom_id = $product['uom_id'];
            $purchaseDetail->quantity = $product['quantity'];
            $purchaseDetail->rate = $product['rate'];
            $purchaseDetail->amount = $product['amount'];
            $sum = $sum + $product['amount'];
            $purchaseDetail->save();

            $vouchers = new StockRegisterSpecificItem();
            $vouchers->dc_id = $purchaseData['id'];
            $vouchers->date = $purchaseData['date'];
            $vouchers->party_id = $purchaseData['party_id'];
            $vouchers->product_id = $product['product_id'];
            $vouchers->voucher_type = "Delivery Challan";
            $vouchers->sale_quantity = $product['quantity'];
            $vouchers->cost_rate = $product['amount'];
            $vouchers->save();

            $ledgerDetail = new LedgerDetailWise();
            $ledgerDetail->dc_id = $purchaseData['id'];
            $ledgerDetail->party_id = $purchaseData['party_id'];
            $ledgerDetail->voucher_no = $purchaseData['dcn_no'];
            $ledgerDetail->voucher_type = $purchaseData['type'];
            $ledgerDetail->date = $purchaseData['date'];
            $ledgerDetail->product_id = $product['product_id'];
            $ledgerDetail->quantity = $product['quantity'];
            $ledgerDetail->rate = $product['rate'];
            $ledgerDetail->debit = $product['amount'];
            $ledgerDetail->save();

            
            $data = PurchaseDetail::where('product_id', '=', $purchaseDetail->product_id)->where('remaining_quantity', '!=', 0)->OrderBy('id', 'asc')->first();
            
            if($purchaseDetail->quantity > $data->remaining_quantity){
                $tot = (int) $purchaseDetail->quantity - (int) $data->remaining_quantity;
                $data->remaining_quantity = 0;
                $data->save();
                
                $data = PurchaseDetail::where('product_id', '=', $purchaseDetail->product_id)->where('remaining_quantity', '!=', 0)->OrderBy('id', 'asc')->first();
                $tot = (int)$data->remaining_quantity - (int)$tot;
                $data->remaining_quantity = $tot;
                $data->save();

            }
            else{
                $data->remaining_quantity =  (int) $data->remaining_quantity - (int) $purchaseDetail->quantity;
            $data->save();
            }
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
    $challans =  DeliveryChallan::with(['challan_details'=>function($query){
        $query->with('products');
        $query->with('unit');
        }])->with('parties')->where('delivery_challans.id', '=', $id)->get();
    $edit = $challans[0];
    //return $edit;
    $parties = Party::where('account_type', 'Client')->OrderBy('party_name', 'asc')->pluck('Party_name', 'id')->toArray();
    // $products = Product::OrderBy('product_name', 'asc')->pluck('product_name', 'product_name')->prepend('Select Product', '0')->toArray();
    $products = Product::select(DB::raw('CONCAT(`id`, "_", `product_name`) AS `id`, `product_name`'))->OrderBy('id', 'asc')->pluck('product_name', 'id')->prepend("Select Product")->toArray();
    $uoms = UOM::select(DB::raw('CONCAT(`id`, "_", `uom`) AS `id`, `uom`'))->OrderBy('id', 'asc')->pluck('uom', 'id')->toArray();
    $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
    return view('delivery-challan.edit', Compact('edit', 'products', 'DeliveryChallan', 'parties', 'uoms', 'encrypted_token')); 
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
        $objPurchase = DeliveryChallan::findOrFail($id);
        $purchase = json_decode(Input::get('grn'), true);
        $objPurchase->party_id = $purchase['party_id'];
        $objPurchase->type = $purchase['type'];
        $objPurchase->dcn_no = $purchase['dcn_no'];
        $objPurchase->date = date('Y-m-d',strtotime($purchase['date']));
        $objPurchase->outward_gpn = $purchase['outward_gpn'];
        $objPurchase->status = $purchase['status'];
        $objPurchase->save();
        DeliveryChallanDetail::where('challan_id', '=', $id)->delete();
        StockRegisterSpecificItem::where('dc_id', '=', $id)->delete();
        LedgerDetailWise::where('dc_id', '=', $id)->delete();
        //GeneralVoucher::where('sale_id', '=', $id)->delete();
        $products = Input::get('details_data');
         //return $products;        
        // $purchaseData = DeliveryChallan::create($purchase);
        $sum = "0";
        foreach($products as $product)
        {
            $purchaseDetail = new DeliveryChallanDetail();
            $purchaseDetail->challan_id = $objPurchase['id'];
            $purchaseDetail->product_id = $product['product_id'];
            $purchaseDetail->uom_id = $product['uom_id'];
            $purchaseDetail->quantity = $product['quantity'];
            $purchaseDetail->rate = $product['rate'];
            $purchaseDetail->amount = $product['amount'];
            $sum = $sum + $product['amount'];
            $purchaseDetail->save();

            $vouchers = new StockRegisterSpecificItem();
            $vouchers->dc_id = $objPurchase['id'];
            $vouchers->date = $objPurchase['date'];
            $vouchers->party_id = $objPurchase['party_id'];
            $vouchers->product_id = $product['product_id'];
            $vouchers->voucher_type = "Delivery Challan";
            $vouchers->sale_quantity = $product['quantity'];
            $vouchers->cost_rate = $product['amount'];
            $vouchers->save();

            $ledgerDetail = new LedgerDetailWise();
            $ledgerDetail->dc_id = $objPurchase['id'];
            $ledgerDetail->party_id = $objPurchase['party_id'];
            $ledgerDetail->voucher_no = $objPurchase['dcn_no'];
            $ledgerDetail->voucher_type = $objPurchase['type'];
            $ledgerDetail->date = $objPurchase['date'];
            $ledgerDetail->product_id = $product['product_id'];
            $ledgerDetail->quantity = $product['quantity'];
            $ledgerDetail->rate = $product['rate'];
            $ledgerDetail->debit = $product['amount'];
            $ledgerDetail->save();

            $data = PurchaseDetail::where('product_id', '=', $purchaseDetail->product_id)->where('remaining_quantity', '!=', 0)->OrderBy('id', 'asc')->first();
            
            if($purchaseDetail->quantity > $data->remaining_quantity){
                $tot = (int) $purchaseDetail->quantity - (int) $data->remaining_quantity;
                $data->remaining_quantity = 0;
                $data->save();
                
                $data = PurchaseDetail::where('product_id', '=', $purchaseDetail->product_id)->where('remaining_quantity', '!=', 0)->OrderBy('id', 'asc')->first();
                $tot = (int)$data->remaining_quantity - (int)$tot;
                $data->remaining_quantity = $tot;
                $data->save();

            }
            else{
                $data->remaining_quantity =  (int) $data->remaining_quantity - (int) $purchaseDetail->quantity;
            $data->save();
            }
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
        $delete = DeliveryChallan::findOrFail($id);
        $delete->delete();
        DeliveryChallanDetail::where('challan_id', '=', $id)->delete();
        StockRegisterSpecificItem::where('dc_id', '=', $id)->delete();
        LedgerDetailWise::where('dc_id', '=', $id)->delete();
        return "Delivery Challan Deleted Successfully!";
    }

        public function ProductKeyUp()
    {
        // return "saleems";
        $productID = Input::get('product_id');
         // $productsArray = Product::where('product_name', '=', $productName)->get(['products.*']);
         // $productName = Input::get('product');
        $data = Product::join('purchase_details', 'purchase_details.product_id', '=', 'products.id')
        ->where('product_id', '=', $productID)
        ->where('remaining_quantity', '!=', 0)
        ->OrderBy('purchase_details.id', 'asc')
        ->first(['products.*','purchase_details.remaining_quantity', 'purchase_details.unit_cost', 'purchase_details.total_cost']);
        //->first();
    $test[] = $data;
    return $test;
        //return $productsArray;
    }


}
