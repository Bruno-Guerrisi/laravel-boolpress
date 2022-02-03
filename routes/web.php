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

// -----------------------------------------front
// Route::get('/', function () {
//     return view('guest.home');
// });

// ---------------------------------rotte per autenticazione
Auth::routes();

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');

        Route::resource('/posts', 'PostController');

        Route::get('/categories/{id}', 'CategoryController@show')->name('category');
    });


// Route::get('/home', 'HomeController@index')->name('home');

/* last route */
Route::get('{any?}', function () {
    return view('guest.home');
})->where('any', '.*');