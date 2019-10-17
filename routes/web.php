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

Route::resource('dashboard', 'DashboardController');
Route::get('calender', 'DashboardController@calender');



//Profit and Loss Account
Route::group(['middleware' => 'roles', 'roles' => ['Admin']], function(){

Route::resource('roles', 'RoleController');
Route::post('roles/adduser', 'RoleController@addUser');
Route::resource('settings', 'SettingController');
Route::get('settings/{id}/destroy', 'SettingController@destroy');
Route::get('settings/{id}/edit', 'SettingController@upload');
});

//Account Group

Route::resource('account-group', 'AccountGroupController');
Route::get('account-group/{id}/destroy', 'AccountGroupController@destroy');

//Catagory
Route::resource('catagories', 'CatagoryController');
Route::get('catagories/{id}/destroy', 'CatagoryController@destroy');
Route::get('catagories/importExcel/create', 'CatagoryController@createImportExcel');
Route::post('catagories/importExcel', 'CatagoryController@ImportExcel');

//Account Settings
Route::resource('account', 'AccountSettingController');

Route::resource('daily-tasks', 'DailyRoutineController');
Route::get('daily-tasks/{id}/destroy', 'DailyRoutineController@destroy');
Route::get('daily-tasks/details/{id}', 'DailyRoutineController@details');

Route::resource('income-tax', 'IncomeTaxController');
Route::get('income-tax/{id}/destroy', 'IncomeTaxController@destroy');
Route::get('income-tax/details/{id}', 'IncomeTaxController@details');

Route::resource('ntn', 'NTNController');
Route::get('ntn/{id}/destroy', 'NTNController@destroy');
Route::get('ntn/details/{id}', 'NTNController@details');

Route::resource('pra', 'PRAController');
Route::get('pra/{id}/destroy', 'PRAController@destroy');
Route::get('pra/details/{id}', 'PRAController@details');

Route::resource('sales-tax', 'SalesTaxController');
Route::get('sales-tax/{id}/destroy', 'SalesTaxController@destroy');
Route::get('sales-tax/details/{id}', 'SalesTaxController@details');

Route::resource('wealth-statement', 'WealthStatementController');
Route::get('wealth-statement/{id}/destroy', 'WealthStatementController@destroy');
Route::get('wealth-statement/details/{id}', 'WealthStatementController@details');



