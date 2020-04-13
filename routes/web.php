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

        Auth::routes(['verify' => true]);

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
            Route::get('/cart/checkout', 'CartController@create')
            ->middleware('verified');
            Route::post('/cart/checkout', 'CartController@done')->middleware('verified');

            Route::get('/user/{user}/profile', 
            'UserController@index');
            Route::get('/user/{user}/orders',
            'UserController@getOrders');
            Route::get('/user/{user}/products',
            'UserController@getProducts');
            Route::get('/user/{user}/users',
            'UserController@getUsers');

            Route::get('/user/{user}/p/create', 'ProductController@create');
            Route::post('/user/{user}/p', 'ProductController@store');
            Route::get(
                '/user/{user}/p/{product}/edit',
                'ProductController@edit'
            )->middleware("can:update,product");
            Route::patch('/p/{product}', 'ProductController@update')->middleware('can:update,product');
            Route::delete('/p/{product}', 'ProductController@destroy')->middleware("can:delete,product");
        });
    }
);

Route::prefix('/api')->middleware('auth')->group(function () {
    Route::post('/p/{product}/rates', 'RateController@store');
    Route::patch('/rates/{rate}', 'RateController@update');
});
