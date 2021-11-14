<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/product', 'ProductController@index')->name('product');
Route::post('/product-store', 'ProductController@store')->name('product.store');
Route::get('/product-list', 'ProductController@list')->name('product.list');
Route::get('/product-delete', 'ProductController@destroy')->name('product.delete');
Route::get('/product-report', 'ProductController@report')->name('product.report');
Route::get('/product_list_pagination', 'ProductController@productListPagination')->name('product.list.pagination');
