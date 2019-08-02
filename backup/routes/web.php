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
Route::resource('dashboard', 'DashboardController');
Route::get('calender', 'DashboardController@calender');

//Purchase
Route::resource('purchases', 'PurchaseController');
//Route::post('purchases/{id}', 'PurchaseController@update');
Route::get('purchases/{id}/destroy', 'PurchaseController@destroy');
Route::get('purchases/print/{id}', 'PurchaseController@print_purchase');
Route::get('purchases/getPDF/{id}', 'PurchaseController@getPDF');
Route::get('purchasetab-ajax', 'PurchaseController@unit_cost');
Route::get('products-ajax', 'PurchaseController@purchase_json');
Route::get('codemouseup-ajax', 'PurchaseController@codeMouseUp');
Route::get('productmouseup-ajax', 'PurchaseController@productMouseUp');
Route::get('quantity-ajax', 'PurchaseController@quantity_json');

//Sales
Route::resource('sales', 'SalesController');
Route::get('sales/{id}/destroy', 'SalesController@destroy');
Route::get('sales/print/{id}', 'SalesController@print_sale');
Route::get('sales/getPDF/{id}', 'SalesController@getPDF');
Route::get('saletab-ajax', 'SalesController@getProduct');
Route::get('products-ajax', 'SalesController@purchase_json');
Route::get('getfirstProduct-ajax', 'SalesController@FirstProduct');
Route::get('productonchange-ajax', 'SalesController@productChange');
//Route::get('quantity-ajax', 'SalesController@quantity_json');

//Parties
Route::resource('parties', 'PartyController');
Route::get('parties/{id}/destroy', 'PartyController@destroy');
Route::get('parties/print/{id}', 'PartyController@print_products');

//Ledger
Route::resource('ledger', 'LedgerController');
Route::get('ledger/{id}/destroy', 'LedgerController@destroy');
Route::get('ledger/print/{id}', 'LedgerController@print_ledger');
Route::get('ledger/getPDF/{id}', 'LedgerController@getPDF');

//Expenses
Route::resource('expenses', 'ExpenseController');
Route::get('expenses/{id}/destroy', 'ExpenseController@destroy');

//Profit and Loss Account
Route::resource('profitloss', 'ProfitLossController');

//Quotations
Route::resource('quotation', 'QuotationController');
Route::get('quotation/{id}/destroy', 'QuotationController@destroy');
Route::get('quotation/print/{id}', 'QuotationController@print_quotation');
Route::get('/getPDF', 'QuotationController@getPDF');

//Products
Route::get('products/print', 'ProductController@print_books');
Route::get('products/pdf', 'ProductController@getPDF');
Route::get('products/downloadExcel', 'ProductController@getExcel');
Route::resource('products', 'ProductController');
Route::get('products/{id}/destroy', 'ProductController@destroy');

Route::get('products/getPDF/{id}', 'ProductController@getPDF');

//Catagory
Route::resource('catagories', 'CatagoryController');
Route::get('catagories/{id}/destroy', 'CatagoryController@destroy');

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

//Settings
Route::resource('settings', 'SettingController');
Route::get('settings/{id}/destroy', 'SettingController@destroy');
Route::get('settings/{id}/edit', 'SettingController@upload');

//Account Settings
Route::resource('account', 'AccountSettingController');

//Purchase Report
Route::resource('purchase-report', 'PurchaseReportController');
Route::get('purchase-report/print', 'PurchaseReportController@print_purchase');

//Sale Report
Route::resource('sale-report', 'SaleReportController');
Route::get('sale-report/print', 'SaleReportController@print_sale');

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


//Role
	Route::get('roles',['as'=>'roles.index','uses'=>'RoleController@index','middleware' => ['permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('roles/create',['as'=>'roles.create','uses'=>'RoleController@create','middleware' => ['permission:role-create']]);
	Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store','middleware' => ['permission:role-create']]);
	Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
	Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit','middleware' => ['permission:role-edit']]);
	Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update','middleware' => ['permission:role-edit']]);
	Route::delete('roles/{id}',['as'=>'roles.destroy','uses'=>'RoleController@destroy','middleware' => ['permission:role-delete']]);

	Route::get('itemCRUD2',['as'=>'itemCRUD2.index','uses'=>'ItemCRUD2Controller@index','middleware' => ['permission:item-list|item-create|item-edit|item-delete']]);
	Route::get('itemCRUD2/create',['as'=>'itemCRUD2.create','uses'=>'ItemCRUD2Controller@create','middleware' => ['permission:item-create']]);
	Route::post('itemCRUD2/create',['as'=>'itemCRUD2.store','uses'=>'ItemCRUD2Controller@store','middleware' => ['permission:item-create']]);
	Route::get('itemCRUD2/{id}',['as'=>'itemCRUD2.show','uses'=>'ItemCRUD2Controller@show']);
	Route::get('itemCRUD2/{id}/edit',['as'=>'itemCRUD2.edit','uses'=>'ItemCRUD2Controller@edit','middleware' => ['permission:item-edit']]);
	Route::patch('itemCRUD2/{id}',['as'=>'itemCRUD2.update','uses'=>'ItemCRUD2Controller@update','middleware' => ['permission:item-edit']]);
	Route::delete('itemCRUD2/{id}',['as'=>'itemCRUD2.destroy','uses'=>'ItemCRUD2Controller@destroy','middleware' => ['permission:item-delete']]);




