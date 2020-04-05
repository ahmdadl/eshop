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

        Route::get('/p/{product}', 'ProductController@show');
    }
);
