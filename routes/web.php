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
// Thi will overwrite the auth:api route. For now we don't need autentication
Route::prefix('api')->group(function () {
    Route::get('/', function () {
        return 'web route: API';
    });
    Route::prefix('products')->group(function () {
        Route::get('/', function () {
            // ProductController@index
            return 'products';
        });
        Route::get('recommended/{city}', function ($city = '') {
            // ProductRecomendationController@listByCity
            return $city;
        });
    });
});