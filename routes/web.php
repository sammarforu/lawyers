<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//Dashboard
Route::get('autocomplete', 'AutoCompleteController@index');
Route::post('autocomplete/fetch', 'AutoCompleteController@store')->name('autocomplete.fetch');
Route::resource('dashboard', 'DashboardController');
Route::get('calender', 'DashboardController@calender');

//GRN
Route::resource('grn', 'GRNController');
Route::get('grn/print/{id}', 'GRNController@print_grn');
Route::get('grn/{id}/destroy', 'GRNController@destroy');
Route::get('grnproductmouseup-ajax', 'GRNController@ProductKeyUp');

//Delivery Challan
Route::resource('delivery-challan', 'DeliveryChallanController');
Route::get('dcproductmouseup-ajax', 'DeliveryChallanController@ProductKeyUp');
Route::get('delivery-challan/{id}/destroy', 'DeliveryChallanController@destroy');
Route::get('delivery-challan/print/{id}', 'DeliveryChallanController@print_challan');

//Purchase
Route::resource('purchases', 'PurchaseController');
//Route::post('purchases/{id}', 'PurchaseController@update');
Route::get('purchases/{id}/destroy', 'PurchaseController@destroy');
Route::get('purchases/print/{id}', 'PurchaseController@print_purchase');
Route::get('purchases/getPDF/{id}', 'PurchaseController@getPDF');
Route::get('purchasetab-ajax', 'PurchaseController@unit_cost');
Route::get('purchases/import-stock/create', 'PurchaseController@createImportExcel');
Route::post('purchases/import-stock', 'PurchaseController@ImportExcel');
Route::get('products-ajax', 'PurchaseController@purchase_json');
Route::get('codemouseup-ajax', 'PurchaseController@codeMouseUp');
Route::get('productmouseup-ajax', 'PurchaseController@ProductKeyUp');
Route::get('quantity-ajax', 'PurchaseController@quantity_json');
Route::get('grnmouseup-ajax', 'PurchaseController@grnMouseUp');

//Purchase Return
Route::resource('purchase-return', 'PurchaseReturnController');
Route::get('purchase-return/print/{id}', 'PurchaseReturnController@print_purchase');
Route::get('purchase-return/{id}/destroy', 'PurchaseReturnController@destroy');

//Sales
Route::resource('sales', 'SalesController');
Route::get('sales/{id}/destroy', 'SalesController@destroy');
Route::get('sales/print/{id}', 'SalesController@print_sale');
Route::get('sales/salespdf/{id}', 'SalesController@getOrderPDF');
//Route::get('sales/getPDF/{id}', 'SalesController@getPDF');
Route::get('saletab-ajax', 'SalesController@CodeChange');
Route::get('productkeyup-ajax', 'SalesController@ProductChange');
Route::get('partyonchange-ajax', 'SalesController@PartyChange');
Route::get('products-ajax', 'SalesController@purchase_json');
Route::get('getfirstProduct-ajax', 'SalesController@FirstProduct');
Route::get('productonchange-ajax', 'SalesController@productChange');
Route::get('dcmouseup-ajax', 'SalesController@DCMouseUp');

//Sale Return
Route::resource('sales-return', 'SaleReturnController');
Route::get('sales-return/print/{id}', 'SaleReturnController@print_sale');
Route::get('sales-return/{id}/destroy', 'SaleReturnController@destroy');

//Purchase Tax invoice
Route::resource('purchase-tax', 'PurchaseTaxController');
Route::get('purchase-tax/print/{id}', 'PurchaseTaxController@print_purchase');
Route::get('purchase-tax/{id}/destroy', 'PurchaseTaxController@destroy');
Route::get('taxpartyonchange-ajax', 'SalesTaxController@PartyChange');
Route::get('taxproductkeyup-ajax', 'SalesTaxController@ProductChange');
Route::get('purchasetaxproductkeyup-ajax', 'PurchaseTaxController@ProductChange');

//Sales Tax invoice
Route::resource('salestax', 'SalesTaxController');
Route::get('salestax/print/{id}', 'SalesTaxController@print_sale');
Route::get('salestax/dcn/{id}', 'SalesTaxController@print_dc');
Route::get('salestax/salestaxpdf/{id}', 'SalesTaxController@print_pdf');
Route::get('salestax/{id}/destroy', 'SalesTaxController@destroy');
Route::get('taxpartyonchange-ajax', 'SalesTaxController@PartyChange');
Route::get('taxproductkeyup-ajax', 'SalesTaxController@ProductChange');

//Parties
Route::get('parties/print', 'PartyController@print_parties');
Route::get('parties/pdf', 'PartyController@getPDF');
Route::get('parties/downloadExcel', 'PartyController@getExcel');
Route::resource('parties', 'PartyController');
Route::get('parties/{id}/destroy', 'PartyController@destroy');
Route::get('parties/print/{id}', 'PartyController@print_products');

//Supplier Ledger
Route::get('ledger/suppliers', 'SupplierLedgerController@index');
Route::get('ledger/suppliers/create', 'SupplierLedgerController@create');
Route::post('ledger/suppliers', 'SupplierLedgerController@store');
Route::get('ledger/suppliers/{id}', 'SupplierLedgerController@show');
Route::get('ledger/suppliers/print/{id}', 'SupplierLedgerController@printledger');
//Ledger
Route::resource('ledger', 'LedgerController');
Route::get('ledger/{id}/destroy', 'LedgerController@destroy');
Route::get('ledger/print/{id}', 'LedgerController@print_ledger');
Route::get('ledger/getPDF/{id}', 'LedgerController@getPDF');

//Expenses Heads
Route::get('expenses/heads', 'ExpenseHeadController@index');
Route::get('expenses/heads/create', 'ExpenseHeadController@create');
Route::post('expenses/heads', 'ExpenseHeadController@store');
Route::get('expenses/heads/{id}/edit', 'ExpenseHeadController@edit');
Route::patch('expenses/heads/{id}', 'ExpenseHeadController@update');
Route::get('expenses/heads/{id}/destroy', 'ExpenseHeadController@destroy');

//Expenses
Route::get('expenses/print', 'ExpenseController@print_expense');
Route::get('expenses/pdf', 'ExpenseController@getPDF');
Route::get('expenses/downloadExcel', 'ExpenseController@getExcel');
Route::resource('expenses', 'ExpenseController');
Route::get('expenses/{id}/destroy', 'ExpenseController@destroy');

//Vouchers
Route::resource('account-head', 'AccountHeadController');
Route::get('account-head/{id}/destroy', 'AccountHeadController@destroy');
Route::get('account-head/print/{id}', 'AccountHeadController@PrintLedger');
Route::resource('opening-balance', 'OpeningBalanceVoucher');
Route::resource('general-voucher', 'GeneralVoucherController');
Route::post('general-voucher/report', 'GeneralVoucherController@report');
Route::resource('bank-payments', 'BankPaymentController');
Route::post('bank-payments/report', 'BankPaymentController@report');
Route::get('cash-receipts/print/{id}', 'CashReceiptController@print_cashReceipt');
Route::resource('cash-receipts', 'CashReceiptController');
Route::get('cash-receipts/{id}/destroy', 'CashReceiptController@destroy');
Route::post('cash-receipts/report', 'CashReceiptController@report');

Route::resource('cash-payments', 'CashPaymentController');
Route::post('cash-payments/report', 'CashPaymentController@report');
Route::get('cash-payments/{id}/destroy', 'CashPaymentController@destroy');
//Route::resource('cheque-payments', 'ChequePaymentController');
Route::resource('bank-receipts', 'BankReceiptController');
Route::get('bank-receipts/{id}/destroy', 'BankReceiptController@destroy');
Route::post('cheque-payments/report', 'ChequePaymentController@report');

Route::resource('vouchers', 'VouchersEditController');
Route::get('vouchers/{id}/destroy', 'VouchersEditController@destroy');
Route::get('vouchers/print/{id}', 'VouchersEditController@print_voucher');
Route::resource('post-cheque-receipt', 'PostChequeController');
Route::resource('cheque-transfer', 'ChequeTransferController');


//Profit and Loss Account
Route::group(['middleware' => 'roles', 'roles' => ['Admin']], function(){
Route::resource('profitloss', 'ProfitLossController');
Route::resource('balance-sheet', 'BalanceSheetController');
Route::resource('trial-balance', 'TrialBalanceController');
Route::resource('cash-book-report', 'CashBookReportController');

//Stock Regiter
Route::resource('stock-register-catagory-wise', 'StockCatagoryWiseController');
Route::resource('stock-register-specific-item', 'StockRegisterController');
Route::post('stock-register-specific-item/report', 'StockRegisterController@report');
Route::post('stock-register-specific-item-fifo/report', 'StockRegisterController@reportFifo');
//Item Wise Ledger
Route::resource('ledger-detail-wise', 'LedgerDetailWiseController');
Route::post('ledger-detail-wise/report', 'LedgerDetailWiseController@report');
//Users management
Route::resource('roles', 'RoleController');
Route::post('roles/adduser', 'RoleController@addUser');

//Settings
Route::resource('settings', 'SettingController');
Route::get('settings/{id}/destroy', 'SettingController@destroy');
Route::get('settings/{id}/edit', 'SettingController@upload');
});
//Quotations
Route::resource('quotation', 'QuotationController');
Route::get('quotation/{id}/destroy', 'QuotationController@destroy');
Route::get('quotation/print/{id}', 'QuotationController@print_quotation');
Route::get('/getPDF', 'QuotationController@getPDF');

//Products

Route::get('products/print', 'ProductController@print_books');
Route::get('products/pdf', 'ProductController@getPDF');
Route::get('products/downloadExcel', 'ProductController@getExcel');
Route::get('products/importExcel/create', 'ProductController@createImportExcel');
Route::post('products/importExcel', 'ProductController@ImportExcel');
Route::resource('products', 'ProductController');
Route::get('products/{id}/destroy', 'ProductController@destroy');
Route::get('products/getPDF/{id}', 'ProductController@getPDF');


//warehouses
Route::resource('warehouses', 'WarehouseController');
Route::get('warehouses/{id}/destroy', 'WarehouseController@destroy');
//banks
Route::resource('banks', 'BanksController');
Route::get('banks/{id}/destroy', 'BanksController@destroy');

//Account Group

Route::resource('account-group', 'AccountGroupController');
Route::get('account-group/{id}/destroy', 'AccountGroupController@destroy');

//Catagory
Route::resource('catagories', 'CatagoryController');
Route::get('catagories/{id}/destroy', 'CatagoryController@destroy');
Route::get('catagories/importExcel/create', 'CatagoryController@createImportExcel');
Route::post('catagories/importExcel', 'CatagoryController@ImportExcel');

//Tax
Route::resource('taxes', 'TaxController');
Route::get('taxes/{id}/destroy', 'TaxController@destroy');

//Repairing
Route::resource('repairing', 'RepairingController');
Route::get('repairing/{id}/destroy', 'RepairingController@destroy');
Route::get('repairing/print/{id}', 'RepairingController@print_repair');

//Discounts
Route::resource('discount', 'DiscountController');
Route::get('discount/{id}/destroy', 'DiscountController@destroy');

//Supplier
Route::resource('supplier', 'SupplierController');
Route::get('supplier/{id}/destroy', 'SupplierController@destroy');
Route::get('supplier/print/{id}', 'SupplierController@print_supplier');
Route::get('supplier/getPDF/{id}', 'SupplierController@getPDF');



//Account Settings
Route::resource('account', 'AccountSettingController');
Route::group(['middleware' => 'roles', 'roles' => ['Admin']], function(){
//Purchase Report
Route::get('purchase-report/create', 'PurchaseReportController@create');
Route::post('purchase-report', 'PurchaseReportController@store');
Route::get('purchase-report/print', 'PurchaseReportController@print_purchase');

//Single Party Purchase Report
Route::resource('single-party-purchase-report', 'SinglePartyPurchaseController');
Route::resource('all-party-purchase-report', 'AllPartyPurchaseController');

//Sale Report
Route::resource('sale-report', 'SaleReportController');
Route::resource('sales-report/single-party', 'SinglePartySaleController');
Route::resource('sales-report/all-party', 'AllPartySaleController');
Route::get('sale-report/print', 'SaleReportController@print_sale');
Route::resource('sample-bills-report', 'SampleBillReportController');

//Saletax Report
Route::resource('salestax-report/all-party', 'SaleTaxReportController');

//Stock Report
Route::get('stock-report/all-items', 'StockReportController@AllItems');

//Expense Report
Route::resource('expense-head-report', 'ExpenseHeadReportController');

//Client All Report

Route::resource('client-all-report', 'ClientAllReportController');
Route::post('client-all-report/report', 'ClientAllReportController@report');
});
//Publisher
Route::resource('publisher', 'PublisherController');
Route::get('publisher/print', 'PublisherController@print_publisher');
Route::get('publisher/{id}/destroy', 'publisherController@destroy');

//JS graph
//Yearly Sale/Purchase
Route::get('reports', 'ReportsController@index');
//Monthly Sale/Purchase
Route::get('reports/month', 'ReportsController@month');
//Daily Sale/Purchase
Route::get('reports/day', 'ReportsController@days');
Route::get('reports/expense', 'ReportsController@expensemonth');

//LC
Route::resource('indentor-info', 'LCIndentorController');
Route::get('indentor-info/{id}/destroy', 'LCIndentorController@destroy');

Route::resource('lc-account', 'LCAccountController');
Route::get('lc-account/{id}/destroy', 'LCAccountController@destroy');

Route::resource('lc-location', 'LCLocationController');
Route::get('lc-location/{id}/destroy', 'LCLocationController@destroy');





//Role
	// Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	// Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create','middleware' => ['permission:role-create']]);
	// Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store','middleware' => ['permission:role-create']]);
	// Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
	// Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit','middleware' => ['permission:role-edit']]);
	// Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update','middleware' => ['permission:role-edit']]);
	// Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']]);

	// Route::get('itemCRUD2',['as'=>'itemCRUD2.index','uses'=>'ItemCRUD2Controller@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);
	// Route::get('itemCRUD2/create',['as'=>'itemCRUD2.create','uses'=>'ItemCRUD2Controller@create','middleware' => ['permission:item-create']]);
	// Route::post('itemCRUD2/create',['as'=>'itemCRUD2.store','uses'=>'ItemCRUD2Controller@store','middleware' => ['permission:item-create']]);
	// Route::get('itemCRUD2/{id}',['as'=>'itemCRUD2.show','uses'=>'ItemCRUD2Controller@show']);
	// Route::get('itemCRUD2/{id}/edit',['as'=>'itemCRUD2.edit','uses'=>'ItemCRUD2Controller@edit','middleware' => ['permission:item-edit']]);
	// Route::patch('itemCRUD2/{id}',['as'=>'itemCRUD2.update','uses'=>'ItemCRUD2Controller@update','middleware' => ['permission:item-edit']]);
	// Route::delete('itemCRUD2/{id}',['as'=>'itemCRUD2.destroy','uses'=>'ItemCRUD2Controller@destroy','middleware' => ['permission:item-delete']]);




