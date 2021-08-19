<?php

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Session as FacadesSession;
use Symfony\Component\HttpFoundation\Session\Session;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/','Admin\HomeAdminController@index');
// Route::get('/','Admin\LoginController@index')->name('users.index');
Route::resource('admin','Admin\LoginController')->except( ['create', 'store']);

Route::get('/','Web\HomeController@index');
Route::get('/Home','Web\HomeController@index');

Route::get('/Booking','Web\BookingController@index');
Route::post('/completebooking','Web\BookingController@completebooking');

Route::get('/Store','Web\StoreController@index');

Route::get('/collections','Web\CollectionsController@index');

Route::get('/product-details','Web\ProductDetailsController@index');
Route::get('/Add-Cart/{id}/{num}','Web\ProductDetailsController@AddCart');
Route::get('/Delete-Item-Cart/{id}','Web\ProductDetailsController@DeleteItemCart');

Route::get('/Shooping-Cart','Web\ShoopingCartController@index');
Route::post('/Update-Item-Cart/{id}/{quanty}','Web\ShoopingCartController@UpdateCart');
Route::post('/Delete-Item-Shooping-Cart/{id}','Web\ShoopingCartController@DeleteItemShoopingCart');

Route::get('/Checkout','Web\CheckoutController@Checkout');

Route::get('/Check-User','Web\LoginController@CheckUser');
Route::post('/Login','Web\LoginController@Login');
Route::post('/Add-Account','Web\LoginController@AddAccount')->name('addaccount');

Route::get('/Logout','Web\LoginController@Logout');