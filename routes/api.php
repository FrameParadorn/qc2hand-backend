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

header('Access-Control-Allow-Origin: *');
header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );

Route::prefix("/rate")->group(function(){

  Route::get('/model/{id?}', 'api\RateController@getModelAll');
  Route::get("/type/{modelId}/{itemId?}", 'api\RateController@getTypeAll');

  Route::post('/item/agree', 'api\RateController@createVote');

});
