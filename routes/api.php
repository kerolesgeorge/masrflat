<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Cities API
Route::get('/cities', 'CityController@index');
Route::post('/cities', 'CityController@store');
Route::patch('/cities/{city}', 'CityController@update');
Route::delete('/cities/{city}', 'CityController@destroy');

// Neighbours API
Route::get('/neighbourhoods', 'NeighbourhoodController@index');
Route::post('/neighbourhoods', 'NeighbourhoodController@store');
Route::patch('/neighbourhoods/{neighbourhood}', 'NeighbourhoodController@update');
Route::delete('/neighbourhoods/{neighbourhood}', 'NeighbourhoodController@destroy');

// Cities - Neighbourhoods
Route::get('/cities/{city}/neighbourhoods', 'CityController@showNeighbourhoods');

// Types API
Route::get('/types', 'TypeController@index');
Route::post('/types', 'TypeController@store');
Route::patch('/types/{type}', 'TypeController@update');
Route::delete('/types/{type}', 'TypeController@destroy');

// Contracts API
Route::get('/contracts', 'ContractController@index');
Route::post('/contracts', 'ContractController@store');
Route::patch('/contracts/{contract}', 'ContractController@update');
Route::delete('/contracts/{contract}', 'ContractController@destroy');
