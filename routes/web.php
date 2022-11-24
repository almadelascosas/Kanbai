<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeleConsultationController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\ProductsController;

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

Auth::routes();

Route::middleware(['auth',])->group(function () {

  Route::get('home', 'HomeController@index')->name('home');
  Route::resource('logins', 'LoginController');
  Route::resource('user',   'UserController');
  Route::resource('permission', 'PermissionController');
  Route::get('logs', 'HomeController@logs')->name('logs');
  Route::resource('roles',   'RolesController');
  Route::resource('categories',   'CategoriesController');
  Route::post('/updatecategory', [CategoriesController::class, 'update'])->name('updatecategory');
  Route::resource('subcategories',   'SubcategoriesController');
  Route::post('/updatesubcategory', [SubCategoriesController::class, 'update'])->name('updatesubcategory');
  Route::resource('products',   'ProductsController');
  Route::post('/updateproduct', [ProductsController::class, 'update'])->name('updateproduct');
  Route::resource('productsgallery',   'ProductsGalleryController'); 
  Route::resource('quotes',   'ProductQuotationController');


  Route::resource('services',   'ServicesController');
  Route::resource('customers',   'CustomersController');

  Route::resource('campus',   'CampusesController');
  Route::resource('invoice',   'InvoiceController');
  Route::get('invoice/customers/{idcustomer}', 'InvoiceController@getcustomer');
  Route::get('invoice/service/{idservice}', 'InvoiceController@getservice');
  Route::get('invoice/cities/{departament}', 'CustomersController@cities');
  Route::resource('pos',   'PosController');
  Route::get('pos/customers/{idcustomer}', 'InvoiceController@getcustomer');
  Route::get('pos/service/{idservice}', 'InvoiceController@getservice');
  Route::get('pos/cities/{departament}', 'CustomersController@cities');
  Route::resource('notacredit',   'CreditNoteController');
  Route::get('notacredit/invoice/{idinvoice}', 'CreditNoteController@getInvoiceById');
  Route::resource('availability',   'AvailabilityController');
  Route::resource('quote',   'QuoteController');
  Route::post('quote/pofesional', 'QuoteController@getquoteprofesional');
  Route::get('clinic-history/customer/{id}', 'ClinicHistoryController@byidcustomer');
  Route::resource('clinic-history',   'ClinicHistoryController');
  Route::resource('quoteanamnesis',   'QuoteAnamnesisController');
  Route::resource('extraoralexam',   'QuoteExtraOralExamController');
  Route::resource('dentalexam',   'QuoteDentalExamController');
  Route::resource('customerodontogram',   'QuoteCustomerOdontogramController');
  Route::get('getodontograma', 'QuoteCustomerOdontogramController@getOdontograma');
  Route::get('getHallazgosDientePaciente', 'QuoteCustomerOdontogramController@getHallazgosDientePaciente');
  Route::resource('typequote',   'TypeQuoteController');
  Route::resource('quotation',   'QuotationController');
  Route::get('quotation/customers/{idcustomer}', 'QuotationController@getcustomer');
  Route::get('quotation/service/{idservice}', 'QuotationController@getservice');
  Route::get('quotation/cities/{departament}', 'QuotationController@cities');
  Route::resource('reportinvoicepos',   'ReportInvoicePosController');
  Route::resource('reportinvoiceelectronic',   'ReportInvoiceElectronicController');
  Route::resource('reportinvoicequotation',   'ReportInvoiceQuotationController');
  Route::resource('tele-consultation',   'TeleConsultationController');
  Route::resource('tele-consultation',   'TeleConsultationController');
  Route::resource('checkoutpayment',   'PaymentController');
  Route::get('/tele-consultation/meet/{meet}', [TeleConsultationController::class, 'show'])->name('show');

});

Route::get('/', 'HomeaplicationController@index')->name('home');
Route::get('/catalogo/{category}', 'ProductsController@productsByCategory');
Route::get('/catalogo/{category}/{bubcategory}', 'ProductsController@productsBySubCategory');
Route::get('/catalogo/producto/{productoid}/{nameproduct}', 'ProductsController@productsByid');
Route::get('/catalogo/cotizacion/porducto/{productoid}', 'ProductsController@quotation');
Route::resource('cotizacion',   'ProductQuotationController');

Route::get('customers/cities/{departament}', 'CustomersController@cities');
Route::get('/registro', 'CustomersController@register')->name('registro');
Route::post('registercustomer', 'CustomersController@registercustomer')->name('registercustomer');


