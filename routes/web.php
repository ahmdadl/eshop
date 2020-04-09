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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeCookieRedirect', 'localeSessionRedirect']
    ],
    function () {
        Route::get('/', 'HomeController@index')->name('home');

        Auth::routes();

        // load all products by a given sub category
        Route::get('/c/{c_slug}/sub/{sub_slug}', 'ProductController@index');

        Route::get('/p/ser', 'ProductController@find');
        Route::get('/p/{product}', 'ProductController@show');
        Route::get('/daily', 'ProductController@dailyDeal');

        Route::get('/cart', 'CartController@index');
        Route::get('/viewCart', 'CartController@show');
        // sessions not working on api routes
        Route::post('/cart', 'CartController@store');
        Route::patch('/cart/{id}', 'CartController@update');
        Route::delete('/cart/{id}', 'CartController@destroy');

        Route::middleware('auth')->group(function () {
            Route::get('/cart/checkout', 'CartController@create');
            Route::post('/cart/checkout', 'CartController@done');

            Route::get('/user/{user}', 'UserController@index');
            Route::get('/user/{user}/orders', 'UserController@getOrders');
            Route::get('/user/{user}/products', 'UserController@getProducts');
        });
    }
);

Route::prefix('/api')->middleware('auth')->group(function () {
    Route::post('/p/{product}/rates', 'RateController@store');
    Route::patch('/rates/{rate}', 'RateController@update');
});
