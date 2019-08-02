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
use App\SaleTax;
use App\SaleTaxDetails;
use App\GeneralVoucher;
use App\LedgerDetailWise;
use App\UOM;
use App\StockRegisterSpecificItem;
use App\SystemLogo;
use DB;
use PDF;
class SalesTaxController extends Controller
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
       $sales = SaleTax::OrderBy('id', 'dsc')->with(['saletax_details'=>function($query){
                    //$query->with('taxes');
                    //$query->with('discount');
                    //$query->with('parties');
                    }])->with('billers')->get();
    //return $sales;
    return view('salestax.index', Compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $code = SaleTax::OrderBy('id', 'asc')->get();
       $codes = $code->last()->invoice_no + 1;
       // $products = Product::OrderBy('product_name', 'asc')->pluck('product_name', 'product_name')->prepend('Start Typing....', '')->toArray();
       $products = Product::select(DB::raw('CONCAT(`id`, "_", `product_name`) AS `id`, `product_name`'))->OrderBy('id', 'asc')->pluck('product_name', 'id')->prepend('Select Product', '0')->toArray();
        $taxes = Tax::select(DB::raw('CONCAT(`id`, "_", `tax_rate`) AS `tax_rate`, `tax_title`'))->OrderBy('id', 'asc')->pluck('tax_title', 'tax_rate')->toArray();
        $discounts = Discount::select(DB::raw('CONCAT(`id`, "_", `discount`) AS `discount`, `title`'))->OrderBy('id', 'asc')->pluck('title', 'discount')->toArray();
        //$discounts = Discount::OrderBy('id', 'asc')->pluck('title', 'id')->prepend('Select Discount', '0')->toArray();
        //$customers = Party::OrderBy('id', 'asc')->pluck('party_name', 'party_name');
        $customers = Party::join('account_groups', 'account_groups.id', '=', 'parties.account_group_id')
            ->where('parties.account_group_id', '=', '1')->OrderBy('party_name', 'asc')->pluck('party_name', 'parties.id')->prepend('Select Customer', '');

        $DeliveryChallan = DeliveryChallan::where('status', '=', 'Pending')->OrderBy('dcn_no', 'asc')->pluck('dcn_no', 'dcn_no')->prepend('Select Challan', '0')->toArray();
        $uoms = UOM::select(DB::raw('CONCAT(`id`, "_", `uom`) AS `id`, `uom`'))->OrderBy('id', 'asc')->pluck('uom', 'id')->toArray();
        
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
        
        return view('salestax.create', Compact('customers', 'products', 'taxes', 'discounts', 'DeliveryChallan', 'codes', 'uoms', 'encrypted_token'));
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
        $purchase['date'] = date('Y/m/d',strtotime($purchase['date']));
        $products = Input::get('product_data');
        //return $purchase; 
        $purchaseData = SaleTax::create($purchase);
    //     if($purchaseData->dcn_no !="0"){
    //      $project = DeliveryChallan::where("dcn_no", $purchaseData->dcn_no)->first();
    //      $project->status = "Added";
    //      $project->save();
    // }
        //return $purchaseData;
        $sum = "0";
        foreach($products as $product)
        {
            $purchaseDetail = new SaleTaxDetails();
            $purchaseDetail->sale_id = $purchaseData['id'];
            $purchaseDetail->product_id = $product['product_id'];
            $purchaseDetail->party_id = $product['party_id'];
            $purchaseDetail->uom_id = $product['uom_id'];
            if(($purchase['lessCommercial']) == "true"){
            $purchaseDetail->status = "stockin";
            }
            else{
            $purchaseDetail->status = "InvoiceOnly";
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
            $vouchers->dc_id = $purchaseData['id'];
            $vouchers->date = $purchaseData['date'];
            $vouchers->party_id = $product['party_id'];
            $vouchers->product_id = $product['product_id'];
            $vouchers->voucher_type = $purchaseData['sale_type'];
            $vouchers->uom_id = $product['uom_id'];
            $vouchers->sale_quantity = $product['quantity'];
            $vouchers->cost_rate = $product['incvalue'];
            $vouchers->save();
             }
            if(($purchase['autocash']) == "true"){

            $vouchers = new LedgerDetailWise();
             $vouchers->dc_id = $purchaseData['id'];
             $vouchers->party_id = $purchaseData['party_id'];
             $vouchers->voucher_no = $purchaseData['invoice_no'];
             $vouchers->voucher_type = "SalesTax Invoice";
             $vouchers->date = $purchaseData['date'];
             $vouchers->product_id = $product['product_id'];
             $vouchers->quantity = $product['quantity'];
             $vouchers->rate = $product['rate'];
             $vouchers->other = $product['TotalTax'];
             $vouchers->credit = $product['incvalue'];
             $vouchers->save();
             }

             if(($purchase['autocash']) == false){
            $vouchers = new LedgerDetailWise();
             $vouchers->dc_id = $purchaseData['id'];
             $vouchers->party_id = $purchaseData['party_id'];
             $vouchers->voucher_no = $purchaseData['invoice_no'];
             $vouchers->voucher_type = "SalesTax Invoice";
             $vouchers->date = $purchaseData['date'];
             $vouchers->product_id = $product['product_id'];
             $vouchers->quantity = $product['quantity'];
             $vouchers->rate = $product['rate'];
             $vouchers->other = $product['TotalTax'];
             $vouchers->debit = $product['incvalue'];
             $vouchers->save();
             }
        }

        if(($purchase['autocash']) == true){

            $vouchers = new GeneralVoucher();
            $vouchers->dc_id = $purchaseData['id'];
            $vouchers->account_head_id = $purchaseData['party_id'];
            $vouchers->date = $purchaseData['date'];
            $vouchers->voucher_no = $purchaseData['invoice_no'];
            $vouchers->v_type = $purchaseData['sale_type'];
            $vouchers->debit = $sum;
            $vouchers->save();
        }

        if(($purchase['autocash']) == false){
             
            $vouchers = new GeneralVoucher();
            $vouchers->dc_id = $purchaseData['id'];
            $vouchers->account_head_id = $purchaseData['party_id'];
            $vouchers->date = $purchaseData['date'];
            $vouchers->voucher_no = $purchaseData['invoice_no'];
            $vouchers->v_type = $purchaseData['sale_type'];
            $vouchers->debit = $sum;
            $vouchers->save();
        }

            // $vouchers = new GeneralVoucher();
            // $vouchers->dc_id = $purchaseData['id'];
            // $vouchers->account_head_id = $purchaseData['party_id'];
            // $vouchers->date = $purchaseData['date'];
            // $vouchers->voucher_no = $purchaseData['invoice_no'];
            // $vouchers->v_type = $purchaseData['sale_type'];
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
        $purchase = SaleTax::with(['saletax_details'=>function($query){
        $query->with('products');
        $query->with('uoms');
        }])->with('parties')->where('sale_taxes.id', '=', $id)->get();
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
        return view('salestax.edit', Compact('edit', 'products', 'DeliveryChallan', 'customers', 'encrypted_token', 'uoms', 'discounts'));
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
        
        $objPurchase = SaleTax::findOrFail($id);
        $purchase = json_decode(Input::get('purchase'), true);
        $objPurchase->party_id = $purchase['party_id'];
        $objPurchase->date = date('Y-m-d',strtotime($purchase['date']));
        $objPurchase->sale_type = $purchase['sale_type'];
        $objPurchase->invoice_no = $purchase['invoice_no'];
        $objPurchase->dcn_no = $purchase['dcn_no'];
        $objPurchase->p_order = $purchase['p_order'];
        $objPurchase->biller = $purchase['biller'];
        $objPurchase->save();
        SaleTaxDetails::where('sale_id', '=', $id)->delete();
        GeneralVoucher::where('dc_id', '=', $id)->delete();
        LedgerDetailWise::where('dc_id', '=', $id)->delete();
        //StockRegisterSpecificItem::where('sale_id', '=', $id)->delete();
        $products = Input::get('product_data'); 
        //return $products;
        $sum = 0;   
        foreach($products as $product)
        {
            $purchaseDetail = new SaleTaxDetails();
            $purchaseDetail->sale_id = $objPurchase['id'];
            $purchaseDetail->product_id = $product['product_id'];
            $purchaseDetail->party_id = $product['party_id'];
            $purchaseDetail->uom_id = $product['uom_id'];
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

            // $vouchers = new StockRegisterSpecificItem();
            // $vouchers->sale_id = $objPurchase['id'];
            // $vouchers->date = $objPurchase['date'];
            // $vouchers->party_id = $product['party_id'];
            // $vouchers->product_id = $product['product_id'];
            // $vouchers->voucher_type = $objPurchase['sale_list'];
            // $vouchers->sale_quantity = $product['quantity'];
            // $vouchers->cost_rate = $product['balance'];
            // $vouchers->save();


            $vouchers = new LedgerDetailWise();
             $vouchers->dc_id = $objPurchase['id'];
             $vouchers->party_id = $objPurchase['party_id'];
             $vouchers->voucher_no = $objPurchase['invoice_no'];
             $vouchers->voucher_type = "SalesTax Invoice";
             $vouchers->date = $objPurchase['date'];
             $vouchers->product_id = $product['product_id'];
             $vouchers->quantity = $product['quantity'];
             $vouchers->rate = $product['rate'];
             $vouchers->other = $product['TotalTax'];
             $vouchers->debit = $product['incvalue'];
             $vouchers->save();

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
        //return $id;
        $delete = SaleTax::findOrFail($id);
        $delete->delete();
        SaleTaxDetails::where('sale_id', '=', $id)->delete();
        GeneralVoucher::where('dc_id', '=', $id)->delete();
        LedgerDetailWise::where('dc_id', '=', $id)->delete();
        return "Sales Tax Invoice Deleted Successfully!";
    }

    public function PartyChange(){
        $partyID = Input::get('party_ID');
        $data = Party::where('id', '=', $partyID)->get();
        return $data;
    }

    public function productChange()
    {
        $productID = Input::get('product_ID');
        // $data = Product::join('purchase_details', 'purchase_details.product_id', '=', 'products.id')
        // ->where('products.id', '=', $productID)
        // ->where('remaining_quantity', '!=', 0)
        // ->OrderBy('purchase_details.id', 'asc')
        // ->first(['products.*','purchase_details.remaining_quantity', 'purchase_details.unit_cost', 'purchase_details.total_cost']);
        //->first();
        $data = Product::where('id', '=', $productID)->get(['products.*']);
    //$test[] = $data;
    return $data;
    }

    public function print_sale($id)
    {
        $newsale_detail = SaleTax::with(['saletax_details'=>function($query){
                                $query->with(['products'=>function($query){
                                }]);
                                //$query->with('taxes');
                                //$query->with('discount');
                                //$query->with('ledger');
                                //$query->with('publishers');
                        }])//->with('parties')->with('billers')
                        ->where('sale_taxes.id', '=', $id)
                        ->get();
        $ledgers = Ledger::with('ledger_party')->where('party_id', '=', $newsale_detail[0]->parties->id)->get();
        //return $newsale_detail;
        
        $company_detail = Setting::where('id', '=', 1)->get();
        $logo = SystemLogo::where('id', '=', 1)->get();
        //return $company_detail;
        return view('salestax.printmyc', Compact('newsale_detail', 'company_detail', 'ledgers', 'logo'));
    }

    
        public function print_pdf($id)
    {
        $newsale_detail = SaleTax::with(['saletax_details'=>function($query){
                                $query->with(['products'=>function($query){
                                }]);
                                //$query->with('taxes');
                                //$query->with('discount');
                                //$query->with('ledger');
                                //$query->with('publishers');
                        }])//->with('parties')->with('billers')
                        ->where('sale_taxes.id', '=', $id)
                        ->get();
        $ledgers = Ledger::with('ledger_party')->where('party_id', '=', $newsale_detail[0]->parties->id)->get();
        //return $newsale_detail;
        
        $company_detail = Setting::where('id', '=', 1)->get();
        $logo = SystemLogo::where('id', '=', 1)->get();
        //return $company_detail;
        $pdf = PDF::loadView('salestax.printpdf', ['newsale_detail' => $newsale_detail, 'company_detail' => $company_detail, 'logo' => $logo]);
        return $pdf->download('salestax_invoice.pdf');
        //return view('salestax.print', Compact('newsale_detail', 'company_detail', 'ledgers', 'logo'));
    }


            public function print_dc($id)
    {
        $newsale_detail = SaleTax::with(['saletax_details'=>function($query){
                                $query->with(['products'=>function($query){
                                }]);
                                //$query->with('taxes');
                                //$query->with('discount');
                                //$query->with('ledger');
                                //$query->with('publishers');
                        }])//->with('parties')->with('billers')
                        ->where('sale_taxes.id', '=', $id)
                        ->get();
        $ledgers = Ledger::with('ledger_party')->where('party_id', '=', $newsale_detail[0]->parties->id)->get();
        //return $newsale_detail;
        
        $company_detail = Setting::where('id', '=', 1)->get();
        $logo = SystemLogo::where('id', '=', 1)->get();
        //return $company_detail;
        return view('salestax.dcn', Compact('newsale_detail', 'company_detail', 'ledgers', 'logo'));
    }
}
