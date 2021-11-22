<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Location;

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
//Auth::routes();

Route::get('/', function () {
    if(!Auth::check()){
        return view('user/login');
    }else{
        return redirect('/user/products');
    }
    
});
Route::get('/login', function () {
    if(!Auth::check()){
        return view('user/login');
    }else{
        return redirect('/user/products');
    }
})->name('login');
Route::get('/register', function () {
    if(!Auth::check()){
        $locations = Location::pluck('name','id');
        return view('user/register')->with(compact('locations'));
    }else{
        return redirect('/user/products');
    }
})->name('register');
Route::get('/logout', 'App\Http\Controllers\UserController@logout');

Route::middleware(['web','auth']) -> prefix('user')->group(function () {
    
    Route::get('/products', "App\Http\Controllers\ProductController@index");
});

//Auth::routes();

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:cache');
    $exitCode = Artisan::call('route:clear');
    return 'DONE'; //Return anything
});


Route::post('/login', "App\Http\Controllers\UserController@login");
Route::post('/admin/login', "App\Http\Controllers\UserController@login");

Route::get('/admin/login', function () {
    if(!Auth::check()){
        return view('admin/login');
    }else if(Auth::user()->role == 'Admin'){
        return redirect('/admin/dashboard');
    }else{
        return view('admin/login');
    }
})->name('admin_login');

Route::middleware(['web','auth','auth.admin'])->prefix('admin')->group(function(){
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('/locations', [App\Http\Controllers\LocationController::class, 'index'])->name('locations');
    Route::get('/product_types', [App\Http\Controllers\ProductTypeController::class, 'index'])->name('product_types');
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'show'])->name('products');
});