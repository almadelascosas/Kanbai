<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeleConsultationController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CustomRequestController;
use App\Http\Controllers\ProjectsController;

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
  Route::resource('user', 'UserController');
  Route::resource('permission', 'PermissionController');
  Route::get('logs', 'HomeController@logs')->name('logs');
  Route::resource('roles', 'RolesController');
  Route::resource('categories', 'CategoriesController');
  Route::post('/updatecategory', [CategoriesController::class, 'update'])->name('updatecategory');
  Route::resource('subcategories', 'SubcategoriesController');
  Route::post('/updatesubcategory', [SubCategoriesController::class, 'update'])->name('updatesubcategory');
  Route::resource('products', 'ProductsController');
  Route::post('/updateproduct', [ProductsController::class, 'update'])->name('updateproduct');
  Route::resource('productsgallery', 'ProductsGalleryController'); 
  Route::resource('categoriesbanner', 'CaregoriesBannersController'); 
  Route::resource('quotes', 'ProductQuotationController');
  Route::resource('comercio', 'ProfileBusinessController');
  Route::resource('mi-perfil', 'ProfileBusinessController');
  Route::get('solicituded-personalizadas', 'CustomRequestController@indexpanel');
  Route::post('/updateproyect', [ProjectsController::class, 'update'])->name('updateproyect');
  Route::resource('solicitud-personalizada', 'CustomRequestController');
  Route::get('/catalogo/cotizacion/porducto/{productoid}', 'ProductsController@quotation');
  Route::resource('cotizacion', 'ProductQuotationController');
  Route::get('projects', 'ProjectsController@indexpanel');
  Route::resource('project', 'ProjectsController');
  Route::get('/mis-proyectos/{id}', 'ProjectsController@index');
  Route::get('/project/chat/{id}', 'ProjectChatController@edit');
  Route::resource('projectchat', 'ProjectChatController');
  Route::get('/proyecto/chat/{id}', 'ProjectChatController@chatuser');

  Route::resource('customers', 'CustomersController');
  Route::resource('services', 'ServicesController');


  Route::resource('typequote', 'TypeQuoteController');
  Route::resource('quotation', 'QuotationController');
  
});

Route::get('/', 'HomeaplicationController@index')->name('home');
Route::get('/catalogo/{category}/{bubcategory}', 'ProductsController@productsBySubCategory');
Route::get('/catalogo/{category}', 'ProductsController@productsByCategory');

Route::get('/catalogo/producto/{productoid}/{nameproduct}', 'ProductsController@productsByid');

Route::get('/buscar/{search}', 'ProductsController@serachproduct')->name('serachproduct');


Route::get('customers/cities/{departament}', 'CustomersController@cities');
Route::get('/registro', 'CustomersController@register')->name('registro');
Route::post('registercustomer', 'CustomersController@registercustomer')->name('registercustomer');

/**Borrar cache */
Route::get('/clear-cache', function () {
  echo Artisan::call('config:clear');
  echo Artisan::call('config:cache');
  echo Artisan::call('cache:clear');
  echo Artisan::call('route:clear');
});


