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

  Route::get('{rateId}/create', 'RateTemplateController@create');
  Route::post('{rateId}', 'RateTemplateController@store');
  Route::post('{rateId}/item/create', 'RateTemplateController@createItem');

});


