<?php

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

Route::get('/home', 'HomeController@index')->name('home');

// Images test
Route::get('/image-gallery', 'ImageController@index');
Route::delete('/images/{image}', 'ImageController@destroy');

// Admin
Route::get('/admin', function() {
    return view('admin.index');
});//->middleware('auth')

// Cities
Route::get('/admin/cities', function() {
    return view('admin.cities.index');
});

// Neighbourhoods
Route::get('/admin/neighbourhoods', function() {
    return view('admin.neighbourhoods.index');
});

// Types
Route::get('admin/types', function() {
    return view('admin.types.index');
});

// Contracts
Route::get('/admin/contracts', function() {
    return view('admin.contracts.index');
});

// Finishes Types
Route::get('/admin/finishes', function() {
    return view('admin.finishes.index');
});

// Views
Route::get('/admin/views', function() {
    return view('admin.views.index');
});

// Estates
Route::get('/admin/estates', function() {
    return view('admin.estates.index');
});
