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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route:: group([ 'prefix' => 'admin/', 'middleware' => 'auth'], function () {

    //Banner section
    Route::get('/admin', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.layout.master');
    Route::resource('/banner', App\Http\Controllers\Admin\BannerController::class);

    //Category section
    Route::resource('/category', App\Http\Controllers\Admin\CategoryController::class);
    Route::post('/category_status', [App\Http\Controllers\Admin\CategoryController::class, 'categorystatus'])->name('category.status');

    //Brand section
    Route::resource('/brand', App\Http\Controllers\Admin\BrandController::class);
    Route::post('/brand_status', [App\Http\Controllers\Admin\BrandController::class, 'brandstatus'])->name('brand.status');

    //Product section
    Route::resource('/product', App\Http\Controllers\Admin\ProductController::class);
    Route::post('/product_status', [App\Http\Controllers\Admin\BrandController::class, 'productstatus'])->name('product.status');

    //User section
    Route::resource('/user', App\Http\Controllers\Admin\UserController::class);
    Route::post('/user_status', [App\Http\Controllers\Admin\UserController::class, 'userstatus'])->name('user.status');





});
