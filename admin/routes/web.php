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


Route::get('/home','AdminController@index')->name('admin.index');
Auth::routes();

Route::get('/','Auth\LoginController@showLoginForm')->name('home');

//Restaurant
Route::get('/restaurant/add','RestaurantController@add')->name('restaurant.add');
Route::post('/restaurant/add','RestaurantController@insert')->name('restaurant.insert');
Route::get('/restaurant/show','RestaurantController@show')->name('restaurant.show');
Route::post('/restaurant/show','RestaurantController@get')->name('restaurant.get');
Route::get('/restaurant/edit/{id}','RestaurantController@edit')->name('restaurant.edit');
Route::post('/restaurant/update','RestaurantController@update')->name('restaurant.update');
Route::post('/restaurant/delete','RestaurantController@destroy')->name('restaurant.delete');


