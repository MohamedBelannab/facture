<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes(['register'=>false]);
//Auth::routes();


 Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('login/{social}', 'Auth\LoginController@redirectToprovider')->name("social_login");
 
Route::get('login/{social}/callback', 'Auth\LoginController@callback')->name("social_login_callback");

Route::resource("invoices" ,"InvoicesController");

Route::resource("sections" ,"SectionController" );

Route::resource("products" , "ProductsController");

Route::post('InvoiceAttachments' , "InvoicesAttachmentsController@store");

Route::get('/section/{id}', 'InvoicesController@getproducts');

Route::get('/InvoicesDetails/{id}' , 'InvoicesDetailesController@edit');

Route::get('/View_File/{invoices_number}/{file_name}' , 'InvoicesDetailesController@open_file');

Route::get('/download/{invoices_number}/{file_name}' , 'InvoicesDetailesController@get_file');

Route::post('/InvoicesDetails/Delete_file' , 'InvoicesDetailesController@destroy')->name('delete_file');

Route::get('/Status_show/{id}', 'InvoicesController@show')->name('Status');

Route::post('/Status_Update/{id}', 'InvoicesController@Status_Update')->name('Status_Update');

Route::get("edit_invoice/{id}" ,"InvoicesController@edit");

Route::get('Invoice_Paid','InvoicesController@Invoice_Paid');

Route::get('Invoice_UnPaid','InvoicesController@Invoice_UnPaid');

Route::get('Invoice_Partial','InvoicesController@Invoice_Partial');

Route::resource('Archive', "InvoiceAchiveController");

Route::get('Print_invoice/{id}' , 'InvoicesController@Print_invoice');

Route::get('invoices_export', 'InvoicesController@export');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
});


Route::get('invoices_report' , 'Invoices_Report@index');
Route::post('search_report' , 'Invoices_Report@Search_invoices');

Route::get('customers_report', 'Customers_Report@index');
Route::post('Search_customers', 'Customers_Report@Search_customers');

Route::get('MarkAsreadAll' ,'InvoicesController@MarkAsreadAll' )->name('MarkAsreadAll');


Route::get('/{page}', 'AdminController@index');





