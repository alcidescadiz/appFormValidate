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

Route::get('/compra', [App\Http\Controllers\CompraController::class, 'index']);
Route::post('/compra', [App\Http\Controllers\CompraController::class, 'store']);
Route::post('/export', [App\Http\Controllers\ExportExcel::class, 'store']);

//Route Hooks - Do not delete//
	Route::view('products', 'livewire.products.index');
	Route::view('categories', 'livewire.categories.index');