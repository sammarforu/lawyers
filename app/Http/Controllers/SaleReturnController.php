<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Product;
use App\PurchaseDetail;
use App\Tax;
use App\Party;
use App\Discount;
use App\UOM;
use App\SaleReturn;
use App\SaleReturnDetails;
use App\Setting;
use App\Ledger;
use App\DeliveryChallan;
use App\DeliveryChallanDetail;
use App\GeneralVoucher;
use App\StockRegisterSpecificItem;
use App\LedgerDetailWise;
use DB;
class SaleReturnController extends Controller
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
    $sales = SaleReturn::OrderBy('id', 'dsc')->with(['sale_return_details'=>function($query){
                    //$query->with('taxes');
                    $query->with('discount');
                    $query->with('parties');
                    }])->with('billers')->get();
    //return $sales;
    return view('sales-return.index', Compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function create()
    {
        $code = SaleReturn::OrderBy('id', 'asc')->get();
        $codes = $code->last()->invoice_no + 1;
         $DeliveryChallan = DeliveryChallan::where('status', '=', 'Pending')->OrderBy('dcn_no', 'asc')->pluck('dcn_no', 'dcn_no')->prepend('Select Challan', '0')->toArray();
        // return $DeliveryChallan;
        //$products = Product::OrderBy('product_name', 'asc')->pluck('product_name', 'id')->prepend('Select Product', '0')->toArray();
        $products = Product::select(DB::raw('CONCAT(`id`, "_", `product_name`) AS `id`, `product_name`'))->OrderBy('id', 'asc')->pluck('product_name', 'id')->prepend('Select Product', '0')->toArray();
        $taxes = Tax::select(DB::raw('CONCAT(`id`, "_", `tax_rate`) AS `tax_rate`, `tax_title`'))->OrderBy('id', 'asc')->pluck('tax_title', 'tax_rate')->toArray();
        $discounts = Discount::select(DB::raw('CONCAT(`id`, "_", `discount`) AS `discount`, `title`'))->OrderBy('id', 'asc')->pluck('title', 'discount')->toArray();
        // $customers = Party::OrderBy('party_name', 'asc')->pluck('party_name', 'id')->prepend('Select Customer', '');
        $customers = Party::join('account_groups', 'account_groups.id', '=', 'parties.account_group_id')
            ->where('parties.account_group_id', '=', '1')->OrderBy('party_name', 'asc')->pluck('party_name', 'parties.id')->prepend('Select Customer', '');
        $uoms = UOM::select(DB::raw('CONCAT(`id`, "_", `uom`) AS `id`, `uom`'))->OrderBy('id', 'asc')->pluck('uom', 'id')->toArray();
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
        return view('sales-return.create', Compact('customers', 'products', 'codes', 'taxes', 'discounts', 'DeliveryChallan', 'encrypted_token', 'uoms'));
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
        $purchaseData = SaleReturn::create($purchase);
        if($purchaseData->dcn_no !="0"){
        $project = DeliveryChallan::where("dcn_no", $purchaseData->dcn_no)->first();
        $project->status = "Added";
        $project->save();
    }
        $sum = "0";
        $tot = "0";
        foreach($products as $product)
        {
            $purchaseDetail = new SaleReturnDetails();
            $purchaseDetail->sale_id = $purchaseData['id'];
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
            $vouchers->sale_ret_id = $purchaseData['id'];
            $vouchers->date = $purchaseData['date'];
            $vouchers->party_id = $product['party_id'];
            $vouchers->product_id = $product['product_id'];
            $vouchers->voucher_type = $purchaseData['sale_type'];
            $vouchers->sale_ret_quantity = $product['quantity'];
            $vouchers->cost_rate = $product['balance'];
            $vouchers->save();

            $vouchers = new LedgerDetailWise();
            $vouchers->sale_ret_id = $purchaseData['id'];
            $vouchers->party_id = $product['party_id'];
            $vouchers->voucher_no = $purchaseData['invoice_no'];
            $vouchers->voucher_type = $purchaseData['sale_type'];
            $vouchers->date = $purchaseData['date'];
            $vouchers->product_id = $product['product_id'];
            $vouchers->quantity = $product['quantity'];
            $vouchers->rate = $product['sale_rate'];
            $vouchers->credit = $product['balance'];
            $vouchers->save();
            // $data = PurchaseDetail::where('product_id', '=', $purchaseDetail->product_id)->where('remaining_quantity', '!=', 0)->OrderBy('id', 'asc')->first();
            
            // if($purchaseDetail->quantity > $data->remaining_quantity){
            //  $tot = (int) $purchaseDetail->quantity - (int) $data->remaining_quantity;
            //  $data->remaining_quantity = 0;
            //  $data->save();
                
            //  $data = PurchaseDetail::where('product_id', '=', $purchaseDetail->product_id)->where('remaining_quantity', '!=', 0)->OrderBy('id', 'asc')->first();
            //  $tot = (int)$data->remaining_quantity - (int)$tot;
            //  $data->remaining_quantity = $tot;
            //  $data->save();

            // }
            // else{
            //  $data->remaining_quantity =  (int) $data->remaining_quantity - (int) $purchaseDetail->quantity;
            // $data->save();
            // }
        }
            $vouchers = new GeneralVoucher();
            $vouchers->sale_ret_id = $purchaseData['id'];
            $vouchers->account_head_id = $purchaseData['party_id'];
            $vouchers->date = $purchaseData['date'];
            $vouchers->voucher_no = $purchaseData['invoice_no'];
            $vouchers->v_type = $purchaseData['sale_type'];
            $vouchers->credit = $sum;
            $vouchers->save();
        
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
        $newsale_detail = SaleReturn::with(['sale_return_details'=>function($query){
                                $query->with('products');
                                //$query->with('taxes');
                                //$query->with('discount');
                                $query->with('parties');
                                }])->with('billers')
                                ->where('sales_returns.id', '=', $id)
                                ->get();
        $company_detail = Setting::where('id', '=', 1)->get();
        //return $newsale_detail;
        return view('sales-return.details', Compact('newsale_detail', 'company_detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
       public function edit($id)
    {
        $purchase = SaleReturn::with(['sale_return_details'=>function($query){
        $query->with('products');
        $query->with('uoms');
        $query->with('discount');
        }])->with('parties')->where('sales_returns.id', '=', $id)->get();
        $DeliveryChallan = DeliveryChallan::where('status', '=', 'Pending')->OrderBy('dcn_no', 'asc')->pluck('dcn_no', 'dcn_no')->prepend('Select Challan', '0')->toArray();
        //$customer = Party::OrderBy('id', 'asc')->pluck('party_name', 'id');
        $edit = $purchase[0];
        //return $edit;
       // $products = Product::OrderBy('product_name', 'asc')->pluck('product_name', 'id')->prepend('Select Product', '0')->toArray();
        $products = Product::select(DB::raw('CONCAT(`id`, "_", `product_name`) AS `id`, `product_name`'))->OrderBy('id', 'asc')->pluck('product_name', 'id')->prepend('Select Product', '0')->toArray();
        //$taxes = Tax::select(DB::raw('CONCAT(`id`, "_", `tax_rate`) AS `tax_rate`, `tax_title`'))->OrderBy('id', 'asc')->pluck('tax_title', 'tax_rate')->toArray();
        //$taxes = Tax::select(DB::raw('CONCAT(`id`, "_", `tax_rate`) AS `tax_rate`, `tax_title`'))->OrderBy('tax_title', 'asc')->pluck('tax_title', 'tax_rate')->prepend('Select Tax', '0.00')->toArray();
        $uoms = UOM::select(DB::raw('CONCAT(`id`, "_", `uom`) AS `id`, `uom`'))->OrderBy('id', 'asc')->pluck('uom', 'id')->toArray();
         $discounts = Discount::select(DB::raw('CONCAT(`id`, "_", `discount`) AS `discount`, `title`'))->OrderBy('id', 'asc')->pluck('title', 'discount')->toArray();
        $customers = Party::OrderBy('party_name', 'asc')->pluck('Party_name', 'id')->prepend('Select Customer', '0')->toArray();
        $encrypter = app('Illuminate\Encryption\Encrypter');
        $encrypted_token = $encrypter->encrypt(csrf_token());
        return view('sales-return.edit', Compact('edit', 'products', 'DeliveryChallan', 'customers', 'encrypted_token', 'uoms', 'discounts'));
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
        $objPurchase = SaleReturn::findOrFail($id);
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

        SaleReturnDetails::where('sale_id', '=', $id)->delete();
        GeneralVoucher::where('sale_ret_id', '=', $id)->delete();
        LedgerDetailWise::where('sale_ret_id', '=', $id)->delete();
        StockRegisterSpecificItem::where('sale_ret_id', '=', $id)->delete();
        // GeneralVoucher::where('sale_id', '=', $id)->delete();
        $products = Input::get('product_data'); 
        $sum = 0;   
        foreach($products as $product)
        {
            $purchaseDetail = new SaleReturnDetails();
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
            $vouchers->sale_ret_id = $objPurchase['id'];
            $vouchers->date = $objPurchase['date'];
            $vouchers->party_id = $product['party_id'];
            $vouchers->product_id = $product['product_id'];
            $vouchers->voucher_type = $objPurchase['sale_list'];
            $vouchers->sale_ret_quantity = $product['quantity'];
            $vouchers->cost_rate = $product['balance'];
            $vouchers->save();

            $vouchers = new LedgerDetailWise();
            $vouchers->sale_ret_id = $objPurchase['id'];
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

        $vouchers = new GeneralVoucher();
            $vouchers->sale_ret_id = $objPurchase['id'];
            $vouchers->account_head_id = $objPurchase['party_id'];
            $vouchers->date = $objPurchase['date'];
            $vouchers->voucher_no = $objPurchase['invoice_no'];
            $vouchers->v_type = $objPurchase['sale_type'];
            $vouchers->credit = $sum;
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
     $delete = SaleReturn::findOrFail($id);
        $delete->delete();
        SaleReturnDetails::where('sale_id', '=', $id)->delete(); 
        StockRegisterSpecificItem::where('sale_ret_id', '=', $id)->delete();
        GeneralVoucher::where('sale_ret_id', '=', $id)->delete(); 
        LedgerDetailWise::where('sale_ret_id', '=', $id)->delete();        
        return "Return Sale has been Deleted Successfully!";
    }

        public function print_sale($id)
    {

        $newsale_detail = SaleReturn::with(['sale_return_details'=>function($query){
                                $query->with('uoms');
                                $query->with(['products'=>function($query){
                                $query->with('publishers');
                                }]);
                                $query->with('taxes');
                                $query->with('discount');
                                //$query->with('publishers');
                        }])->with('parties')->with('billers')
                        ->where('sales_returns.id', '=', $id)
                        ->get();
        //return $newsale_detail;
        //return $newsale_detail;                   
        //$ledgers = Ledger::join('parties', 'parties.id',  'ledgers.party_id')
                          //->where('party_id', '=', 5)->OrderBy('id', 'asc')->get(['ledgers.*', 'parties.party_name as partyname, parties.phone, parties.city']);
        
        //$ledgers = Party::with('ledgers')->get();
        //return $ledgers;
        //return $newsale_detail[0]->parties->id;
        $ledgers = Ledger::with('ledger_party')->where('party_id', '=', $newsale_detail[0]->parties->id)->get();
        //return $ledgers;
        
        $company_detail = Setting::where('id', '=', 1)->get();
        return view('sales-return.print', Compact('newsale_detail', 'company_detail', 'ledgers'));
    }
}
