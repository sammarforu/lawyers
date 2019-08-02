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
use App\PurchaseTax;
use App\PurchaseTaxDetails;
use App\GeneralVoucher;
use App\LedgerDetailWise;
use App\UOM;
use App\StockRegisterSpecificItem;
use DB;
class PurchaseTaxController extends Controller
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
       $purchases = PurchaseTax::OrderBy('id', 'dsc')->with(['purchasetax_details'=>function($query){
                    //$query->with('taxes');
                    //$query->with('discount');
                    //$query->with('parties');
                    }])->with('billers')->get();
    //return $sales;
    return view('purchase-tax.index', Compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function create()
    {
        $code = PurchaseTax::OrderBy('id', 'asc')->get();
       $codes = $code->last()->voucher_no + 1;
       // $products = Product::OrderBy('product_name', 'asc')->pluck('product_name', 'product_name')->prepend('Start Typing....', '')->toArray();
       $products = Product::select(DB::raw('CONCAT(`id`, "_", `product_name`) AS `id`, `product_name`'))->OrderBy('id', 'asc')->pluck('product_name', 'id')->prepend('Select Product', '0')->toArray();
        $taxes = Tax::select(DB::raw('CONCAT(`id`, "_", `tax_rate`) AS `tax_rate`, `tax_title`'))->OrderBy('id', 'asc')->pluck('tax_title', 'tax_rate')->toArray();
        $customers = Party::join('account_groups', 'account_groups.id', '=', 'parties.account_group_id')
            ->where('parties.account_group_id', '=', '2')->OrderBy('party_name', 'asc')->pluck('party_name', 'parties.id')->prepend('Select Customer', '');
        $uoms = UOM::select(DB::raw('CONCAT(`id`, "_", `uom`) AS `id`, `uom`'))->OrderBy('id', 'asc')->pluck('uom', 'id')->toArray();
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
        
        return view('purchase-tax.create', Compact('customers', 'products', 'taxes', 'discounts', 'DeliveryChallan', 'codes', 'uoms', 'encrypted_token'));
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
        //return $purchase;
        $purchase['date'] = date('Y/m/d',strtotime($purchase['date']));
        $products = Input::get('product_data');
         
        $purchaseData = PurchaseTax::create($purchase);
        $sum = "0";
        foreach($products as $product)
        {
            $purchaseDetail = new PurchaseTaxDetails();
            $purchaseDetail->purchase_id = $purchaseData['id'];
            $purchaseDetail->product_id = $product['product_id'];
            $purchaseDetail->party_id = $product['party_id'];
            $purchaseDetail->uom_id = $product['uom_id'];
            if(($purchase['lessCommercial']) == "true"){
            $purchaseDetail->status = "1";
            }
            else{
            $purchaseDetail->status = "0";
            }
            $purchaseDetail->quantity = $product['quantity'];
            $purchaseDetail->rate = $product['rate'];
            $purchaseDetail->stvalue = $product['stvalue'];
            $purchaseDetail->taxvalue = $product['taxvalue'];
            $purchaseDetail->extratax = $product['extratax'];
            $purchaseDetail->extraTaxValue = $product['extraTaxValue'];
            $purchaseDetail->price = $product['excvalue'];
            $purchaseDetail->total = $product['incvalue'];           
            $sum = $sum + $product['incvalue'];           
            $purchaseDetail->save();

            if(($purchase['lessCommercial']) == "true"){
            $vouchers = new StockRegisterSpecificItem();
            $vouchers->purchasetax_id = $purchaseData['id'];
            $vouchers->date = $purchaseData['date'];
            $vouchers->party_id = $product['party_id'];
            $vouchers->product_id = $product['product_id'];
            $vouchers->voucher_type = $purchaseData['purchase_type'];
            $vouchers->uom_id = $product['uom_id'];
            $vouchers->sale_quantity = $product['quantity'];
            $vouchers->cost_rate = $product['incvalue'];
            $vouchers->save();
             }
            // if(($purchase['autocash']) == "true"){
            // $vouchers = new LedgerDetailWise();
            //  $vouchers->purchasetax_id = $purchaseData['id'];
            //  $vouchers->party_id = $purchaseData['party_id'];
            //  $vouchers->voucher_no = $purchaseData['invoice_no'];
            //  $vouchers->voucher_type = "PurchaseTax Invoice";
            //  $vouchers->date = $purchaseData['date'];
            //  $vouchers->product_id = $product['product_id'];
            //  $vouchers->quantity = $product['quantity'];
            //  $vouchers->rate = $product['rate'];
            //  $vouchers->other = $product['TotalTax'];
            //  $vouchers->credit = $product['incvalue'];
            //  $vouchers->save();
            //  }

             if(($purchase['autocash']) == "false"){
            $vouchers = new LedgerDetailWise();
             $vouchers->purchasetax_id = $purchaseData['id'];
             $vouchers->party_id = $purchaseData['party_id'];
             $vouchers->voucher_no = $purchaseData['voucher_no'];
             $vouchers->invoice_no = $purchaseData['invoice_no'];
             $vouchers->voucher_type = "PurchaseTax Invoice";
             $vouchers->date = $purchaseData['date'];
             $vouchers->product_id = $product['product_id'];
             $vouchers->quantity = $product['quantity'];
             $vouchers->rate = $product['rate'];
             $vouchers->other = $product['TotalTax'];
             $vouchers->debit = $product['incvalue'];
             $vouchers->save();
             }
        }

        if(($purchase['autocash']) == "true"){
            $vouchers = new GeneralVoucher();
            $vouchers->purchasetax_id = $purchaseData['id'];
            $vouchers->account_head_id = $purchaseData['party_id'];
            $vouchers->date = $purchaseData['date'];
            $vouchers->voucher_no = $purchaseData['voucher_no'];
            $vouchers->v_type = $purchaseData['purchase_type'];
            $vouchers->debit = $sum;
            $vouchers->save();
        }

            // $vouchers = new GeneralVoucher();
            // $vouchers->dc_id = $purchaseData['id'];
            // $vouchers->account_head_id = $purchaseData['party_id'];
            // $vouchers->date = $purchaseData['date'];
            // $vouchers->voucher_no = $purchaseData['invoice_no'];
            // $vouchers->v_type = $purchaseData['purchase_type'];
            // $vouchers->debit = $sum;
            // $vouchers->save();
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
        $purchase = PurchaseTax::with(['purchasetax_details'=>function($query){
        $query->with('products');
        $query->with('uoms');
        }])->with('parties')->where('purchase_taxes.id', '=', $id)->get();
        //return $purchase;
        $DeliveryChallan = DeliveryChallan::where('status', '=', 'Pending')->OrderBy('dcn_no', 'asc')->pluck('dcn_no', 'dcn_no')->prepend('Select Challan', '0')->toArray();
        //$customer = Party::OrderBy('id', 'asc')->pluck('party_name', 'id');
        $edit = $purchase[0];
        //return $edit;
        $products = Product::select(DB::raw('CONCAT(`id`, "_", `product_name`) AS `id`, `product_name`'))->OrderBy('id', 'asc')->pluck('product_name', 'id')->prepend('Select Product', '0')->toArray();
        //$taxes = Tax::select(DB::raw('CONCAT(`id`, "_", `tax_rate`) AS `tax_rate`, `tax_title`'))->OrderBy('id', 'asc')->pluck('tax_title', 'tax_rate')->toArray();
        
        //$taxes = Tax::select(DB::raw('CONCAT(`id`, "_", `tax_rate`) AS `tax_rate`, `tax_title`'))->OrderBy('tax_title', 'asc')->pluck('tax_title', 'tax_rate')->prepend('Select Tax', '0.00')->toArray();
        $customers = Party::OrderBy('party_name', 'asc')->pluck('Party_name', 'id')->prepend('Select Customer', '0')->toArray();
         $uoms = UOM::select(DB::raw('CONCAT(`id`, "_", `uom`) AS `id`, `uom`'))->OrderBy('id', 'asc')->pluck('uom', 'id')->toArray();
         $discounts = Discount::select(DB::raw('CONCAT(`id`, "_", `discount`) AS `discount`, `title`'))->OrderBy('id', 'asc')->pluck('title', 'discount')->toArray();
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
        return view('purchase-tax.edit', Compact('edit', 'products', 'DeliveryChallan', 'customers', 'encrypted_token', 'uoms', 'discounts'));
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
        
        $objPurchase = PurchaseTax::findOrFail($id);
        $purchase = json_decode(Input::get('purchase'), true);
        $objPurchase->party_id = $purchase['party_id'];
        $objPurchase->date = date('Y-m-d',strtotime($purchase['date']));
        $objPurchase->voucher_no = $purchase['voucher_no'];
        $objPurchase->purchase_type = $purchase['purchase_type'];
        $objPurchase->invoice_no = $purchase['invoice_no'];
        $objPurchase->remarks = $purchase['remarks'];
        $objPurchase->p_order = $purchase['p_order'];
        $objPurchase->biller = $purchase['biller'];
        $objPurchase->save();
        PurchaseTaxDetails::where('purchase_id', '=', $id)->delete();
        GeneralVoucher::where('purchasetax_id', '=', $id)->delete();
        LedgerDetailWise::where('purchasetax_id', '=', $id)->delete();
        StockRegisterSpecificItem::where('purchasetax_id', '=', $id)->delete();
        $products = Input::get('product_data'); 
        //return $products;
        $sum = 0;   
        foreach($products as $product)
        {
            $purchaseDetail = new PurchaseTaxDetails();
            $purchaseDetail->purchase_id = $purchaseData['id'];
            $purchaseDetail->product_id = $product['product_id'];
            $purchaseDetail->party_id = $product['party_id'];
            $purchaseDetail->uom_id = $product['uom_id'];
            if(($purchase['lessCommercial']) == "true"){
            $purchaseDetail->status = "1";
            }
            else{
            $purchaseDetail->status = "0";
            }
            $purchaseDetail->quantity = $product['quantity'];
            $purchaseDetail->rate = $product['rate'];
            $purchaseDetail->stvalue = $product['stvalue'];
            $purchaseDetail->taxvalue = $product['taxvalue'];
            $purchaseDetail->extratax = $product['extratax'];
            $purchaseDetail->extraTaxValue = $product['extraTaxValue'];
            $purchaseDetail->price = $product['excvalue'];
            $purchaseDetail->total = $product['incvalue'];           
            $sum = $sum + $product['incvalue'];           
            $purchaseDetail->save();

            if(($purchase['lessCommercial']) == "true"){
            $vouchers = new StockRegisterSpecificItem();
            $vouchers->purchasetax_id = $purchaseData['id'];
            $vouchers->date = $purchaseData['date'];
            $vouchers->party_id = $product['party_id'];
            $vouchers->product_id = $product['product_id'];
            $vouchers->voucher_type = $purchaseData['purchase_type'];
            $vouchers->uom_id = $product['uom_id'];
            $vouchers->sale_quantity = $product['quantity'];
            $vouchers->cost_rate = $product['incvalue'];
            $vouchers->save();
             }
            // if(($purchase['autocash']) == "true"){
            // $vouchers = new LedgerDetailWise();
            //  $vouchers->purchasetax_id = $purchaseData['id'];
            //  $vouchers->party_id = $purchaseData['party_id'];
            //  $vouchers->voucher_no = $purchaseData['invoice_no'];
            //  $vouchers->voucher_type = "PurchaseTax Invoice";
            //  $vouchers->date = $purchaseData['date'];
            //  $vouchers->product_id = $product['product_id'];
            //  $vouchers->quantity = $product['quantity'];
            //  $vouchers->rate = $product['rate'];
            //  $vouchers->other = $product['TotalTax'];
            //  $vouchers->credit = $product['incvalue'];
            //  $vouchers->save();
            //  }

             if(($purchase['autocash']) == "false"){
            $vouchers = new LedgerDetailWise();
             $vouchers->purchasetax_id = $purchaseData['id'];
             $vouchers->party_id = $purchaseData['party_id'];
             $vouchers->voucher_no = $purchaseData['invoice_no'];
             $vouchers->invoice_no = $purchaseData['invoice_no'];
             $vouchers->voucher_type = "PurchaseTax Invoice";
             $vouchers->date = $purchaseData['date'];
             $vouchers->product_id = $product['product_id'];
             $vouchers->quantity = $product['quantity'];
             $vouchers->rate = $product['rate'];
             $vouchers->other = $product['TotalTax'];
             $vouchers->debit = $product['incvalue'];
             $vouchers->save();
             }

        }

            $vouchers = new GeneralVoucher();
            $vouchers->dc_id = $objPurchase['id'];
            $vouchers->account_head_id = $objPurchase['party_id'];
            $vouchers->date = $objPurchase['date'];
            $vouchers->voucher_no = $objPurchase['invoice_no'];
            $vouchers->v_type = $objPurchase['sale_type'];
            $vouchers->debit = $sum;
            $vouchers->save();

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
    $delete = PurchaseTax::findOrFail($id);
    $delete->delete();
    PurchaseTaxDetails::where('purchase_id', '=', $id)->delete();
    GeneralVoucher::where('purchasetax_id', '=', $id)->delete();
    LedgerDetailWise::where('purchasetax_id', '=', $id)->delete();
    return "Purchase Tax Invoice Deleted Successfully!";
    }

    public function print_purchase($id)
    {
        $newsale_detail = PurchaseTax::with(['purchasetax_details'=>function($query){
                                $query->with(['products'=>function($query){
                                }]);
                                //$query->with('taxes');
                                //$query->with('discount');
                                //$query->with('ledger');
                                //$query->with('publishers');
                        }])//->with('parties')->with('billers')
                        ->where('purchase_taxes.id', '=', $id)
                        ->get();
        $ledgers = Ledger::with('ledger_party')->where('party_id', '=', $newsale_detail[0]->parties->id)->get();
        //return $newsale_detail;
        
        $company_detail = Setting::where('id', '=', 1)->get();
        //return $company_detail;
        return view('purchase-tax.print', Compact('newsale_detail', 'company_detail', 'ledgers'));
    }

        public function productChange()
    {
        $productID = Input::get('product_ID');
        $data = Product::where('id', '=', $productID)->get(['products.*']);
    //$test[] = $data;
    return $data;
    }
}
