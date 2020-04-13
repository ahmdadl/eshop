<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:web')->group(function () {
    
});

Route::get('/sub/{category_slug}', 'HomeController@sendData');

Route::get('/sub/{category_slug}/filterBrands/{brands}', 'ProductController@filterBrands');
Route::get('/sub/{category_slug}/filterCondition/{is_used}', 'ProductController@filterCondition');
Route::get('/sub/{category_slug}/priceFilter/{from}/{to}', 'ProductController@filterByPrice');

Route::get('/p/{product}', 'ProductController@findOne');
Route::get('/p/{product}/rates', 'RateController@index');

