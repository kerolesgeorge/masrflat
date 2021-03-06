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

/**
 * Web pages routes
 */
Route::get('/', function () {
    return view('welcome');
});

Route::get('/estates', function () {
    return view('estates');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Admin Routes
 */
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
