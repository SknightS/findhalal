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
Route::get('/Items/edit/{id}','ItemController@edit')->name('item.edit');
Route::post('/Items/update/{id}','ItemController@update')->name('item.update');

Route::get('/Items/editItemSize/{id}','ItemController@editItemSize')->name('itemSize.edit');
Route::post('/Items/updateItemSize/{id}','ItemController@updateItemSize')->name('itemSize.update');
Route::get('/Items/addItemSize/{id}','ItemController@addItemSize')->name('itemSize.add');
Route::post('/Items/addItemSize/{id}','ItemController@insertItemSize')->name('itemSize.insert');

Route::get('/Items/showImage/{id}','ItemController@fullImageShow')->name('image.show');
Route::get('/Items/deleteImage/{id}','ItemController@deleteItemImage')->name('image.delete');

//Category
Route::get('/category/show','CategoryController@show')->name('category.show');
Route::get('/category/add','CategoryController@add')->name('category.add');
Route::post('/category/add','CategoryController@insert')->name('category.insert');
Route::get('/category/edit/{id}','CategoryController@edit')->name('category.edit');
Route::post('/category/edit','CategoryController@update')->name('category.update');
Route::post('/category/show','CategoryController@getCategoryData')->name('category.get');
Route::post('/category/delete','CategoryController@destroy')->name('category.delete');



//Settings
Route::get('settings','AdminController@settings')->name('settings');
Route::post('settings','AdminController@changePass')->name('changePass');





