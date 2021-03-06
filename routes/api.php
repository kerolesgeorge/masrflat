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
Route::apiResource('/cities', 'CityController');

// Neighbours API
Route::apiResource('/neighbourhoods', 'NeighbourhoodController');

// Cities - Neighbourhoods
Route::get('/neighbourhoods/{neighbourhood}/city', 'NeighbourhoodController@getCityNeighbourhoods');
Route::get('/cities/{city}/neighbourhoods', 'CityController@neighbourhoods');

// Types API
Route::apiResource('/types', 'TypeController');

// Contracts API
Route::apiResource('/contracts', 'ContractController');

// Finishes API
Route::apiResource('/finishtypes', 'FinishTypeController');

// Views API
Route::apiResource('/views', 'ViewController');

// Estates API
Route::apiResource('/estates', 'EstateController');

// Estate upload attachments
Route::post('/attachments', 'EstateController@uploadAttached');
Route::delete('/attachments/{index}', 'EstateController@deleteAttached');

// Estate edit attachments
Route::post('/attachments/{estate}', 'EstateController@updateAttached');
Route::delete('/images/{image}', 'ImageController@destroy');
