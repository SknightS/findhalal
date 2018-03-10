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


//Item
Route::get('/Items/addItems','ItemController@add')->name('item.add');
Route::post('/Items/allCategoryByResturant','ItemController@getItemCatByResId')->name('item.categoryByRes');
Route::post('/Items/insert','ItemController@insert')->name('item.insert');
Route::get('/Items/show','ItemController@show')->name('item.show');
Route::post('/Items/show','ItemController@get')->name('item.get');
//Route::get('/restaurant/edit/{id}','RestaurantController@edit')->name('restaurant.edit');


