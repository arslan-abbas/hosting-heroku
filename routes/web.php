<?php

use Illuminate\Support\Facades\Route;


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
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('product-list', [App\Http\Controllers\ProductController::class, 'index']);
Route::get('product-list/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit']);
Route::post('product-list/store', [App\Http\Controllers\ProductController::class, 'store']);
Route::get('product-list/delete/{id}', [App\Http\Controllers\ProductController::class, 'destroy']);
Route::get('export-products', [App\Http\Controllers\ProductController::class, 'exportProduct'])->name('export-products');
Route::get('export-products-pdf', [App\Http\Controllers\ProductController::class, 'exportProductPDF'])->name('export-products-pdf');
Route::get('download-zip-products-pdf', [App\Http\Controllers\ProductController::class, 'downloadZipProductPDF'])->name('download-zip-products-pdf');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/private', [App\Http\Controllers\HomeController::class, 'private'])->name('private');
Route::get('/users', [App\Http\Controllers\HomeController::class, 'users'])->name('users');

Route::get('messages', 'MessageController@fetchMessages');
Route::post('messages', 'MessageController@sendMessage');
Route::get('/private-messages/{user}', 'MessageController@privateMessages')->name('privateMessages');
Route::post('/private-messages/{user}', 'MessageController@sendPrivateMessage')->name('privateMessages.store');
