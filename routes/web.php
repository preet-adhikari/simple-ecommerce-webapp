<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
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


//Route::view('home','home')->middleware('auth');
//Route::get('bill',[BillController::class,'show'])->name('bill');
//Route::post('bills',[BillController::class,'add'])->name('billAdd');

Route::group(['prefix' => 'admin','middleware' => 'auth'], function (){
    Route::get('/destroyCategory/{id}',[CategoryController::class,'destroy'])->name('category.Destroy');
    Route::resource('category',CategoryController::class,['except' => 'destroy']);
    Route::get('/deleteBrand/{id}',[BrandController::class,'delete'])->name('brand.delete');
    Route::resource('brands',BrandController::class);
    Route::resource('product', ProductController::class, ['except' => 'destroy']);
    Route::get('/destroyProduct/{id}',[ProductController::class,'destroy'])->name('product.destroy');
});

//Customer Authentication
Route::get('/customer/login',[CustomerController::class,'login'])->name('customer.login')->middleware('customer.auth');
Route::post('/customer/loginCheck',[CustomerController::class,'loginCheck'])->name('customer.loginCheck');
Route::get('/customer/register',[CustomerController::class,'register'])->name('customer.register')->middleware('customer.auth');
Route::post('customer/logout',[CustomerController::class,'logout'])->name('customer.logout');
Route::resource('customer', CustomerController::class);

Route::get('/', function (){
    $categories = Category::all();
    return view('index',compact('categories'));
})->middleware('customer.auth');
