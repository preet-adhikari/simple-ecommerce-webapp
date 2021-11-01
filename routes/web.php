<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
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

Route::get('/admin', function () {
    return view('admin.home');
})->middleware('auth');

Route::view('home','home')->middleware('auth');
//Route::get('bill',[BillController::class,'show'])->name('bill');
//Route::post('bills',[BillController::class,'add'])->name('billAdd');

Route::group(['prefix' => 'admin','middleware' => 'auth'], function (){
    Route::get('/destroyCategory/{id}',[CategoryController::class,'destroy'])->name('category.Destroy');
    Route::resource('category',CategoryController::class,['except' => 'destroy']);
    Route::get('/deleteBrand/{id}',[BrandController::class,'delete'])->name('brand.delete');
    Route::resource('brands',BrandController::class);
});
