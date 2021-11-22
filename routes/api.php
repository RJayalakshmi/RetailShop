<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route; 
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use App\Models\Location;
use App\Models\ProductType;
use App\Models\Product;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->group(function(){
    Route::middleware(['auth:api'])->group(function () {
        Route::get('locations', function () {
            return (new JsonResource(Location::all()))->additional(['status' => 'Success']);
        });
        Route::get('product_types', function () {
            //return new UserCollection(User::all());
            return (new JsonResource(ProductType::all()))->additional(['status' => 'Success']);
        });
    });

Route::middleware(['auth:api','auth.admin:api'])->prefix('admin')->group(function () {
    Route::get('users', function () {
        //return new UserCollection(User::all());
        return (new JsonResource(User::all()))->additional(['status' => 'Success']);
    });
    Route::get('user/{id}', function ($id) {
        return (new JsonResource(User::findOrFail($id)))->additional(['status' => 'Success']);
    });

    Route::get('location/{id}', function ($id) {
        return (new JsonResource(Location::find($id)))->additional(['status' => 'Success']);
    });
    Route::apiResource('/location', "App\Http\Controllers\LocationController");
    
    Route::get('product_type/{id}', function ($id) {
        return (new JsonResource(ProductType::find($id)))->additional(['status' => 'Success']);
    });

    Route::apiResource('/product_type', "App\Http\Controllers\ProductTypeController");
    
    Route::get('products', function () {
        return (new JsonResource(Product::all()))->additional(['status' => 'Success']);
    });
    Route::get('product/{id}', function ($id) {
        return (new JsonResource(Product::find($id)))->additional(['status' => 'Success']);
    });

    Route::apiResource('/product', "App\Http\Controllers\ProductController");

});

Route::prefix('user')->group(function () {
    Route::post('/register', "App\Http\Controllers\UserController@store");
    Route::post('/login', "App\Http\Controllers\UserController@login");
    Route::middleware(['auth:api'])->group(function () {
        Route::get('products', function () {
            //return new UserCollection(User::all());
            return (new JsonResource(Product::userProducts()->get()))->additional(['status' => 'Success']);
        });
    });
});

});

Route::middleware('auth:passport')->get('/user', function (Request $request) {
    return $request->user();
});