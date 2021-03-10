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

Route::post("rate/{id}", 'RateController@upload');
Route::resource('rate', 'RateController');


Route::prefix('rate-template')->group(function() {

  Route::get('{rateId}/create/{typeId?}/{subId?}', 'RateTemplateController@create');
  Route::get('{rateId}/edit/{typeId}', 'RateTemplateController@edit');
  Route::post('{rateId}/{subId?}', 'RateTemplateController@store');
  Route::put('{rateId}/update/{typeId}', 'RateTemplateController@update');


  Route::post('{rateId}/type/{typeId}/item/create', 'RateTemplateController@createItem');
  Route::post('{rateId}/type/{typeId}/item/update/{itemId}', 'RateTemplateController@updateItem');
  Route::post('{rateId}/type/{typeId}/item/delete/{itemId}', 'RateTemplateController@deleteItem');

});


