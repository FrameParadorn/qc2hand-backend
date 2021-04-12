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
    return view("auth.login");
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get("rate", 'RateController@index')->middleware('auth');
Route::get("rate/{id}", 'RateController@show')->middleware('auth');
Route::post("rate/{id}", 'RateController@upload')->middleware('auth');

Route::post("blog/upload", "BlogController@upload")->middleware('auth');
Route::resource('blog', 'BlogController')->middleware('auth');


Route::prefix('rate-template')->group(function() {

  Route::get('{rateId}/create/{typeId?}/{subId?}', 'RateTemplateController@create')->middleware('auth');
  Route::get('{rateId}/edit/{typeId}', 'RateTemplateController@edit')->middleware('auth');
  Route::post('{rateId}/{subId?}', 'RateTemplateController@store')->middleware('auth');
  Route::put('{rateId}/update/{typeId}', 'RateTemplateController@update')->middleware('auth');


  Route::post('{rateId}/type/{typeId}/item/create', 'RateTemplateController@createItem')->middleware('auth');
  Route::post('{rateId}/type/{typeId}/item/update/{itemId}', 'RateTemplateController@updateItem')->middleware('auth');
  Route::post('{rateId}/type/{typeId}/item/delete/{itemId}', 'RateTemplateController@deleteItem')->middleware('auth');

});


