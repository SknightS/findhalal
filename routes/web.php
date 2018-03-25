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

Route::get('/','HomeController@index')->name('home');
Route::view('/food/result','food.foodResult')->name('food.result');
Route::view('/map/result','map.mapResult')->name('map.result');
//Route::view('/restaurants','restaurants.index')->name('restaurant.result');
Route::view('/restaurants/profile','restaurants.profile')->name('restaurant.profile');
Route::view('/contact','contact')->name('contact');
Route::view('/registration','registration')->name('registration');
//Route::view('/checkout','checkout')->name('checkout');

Route::post('/restaurants/result','RestaurantController@Restaurants')->name('restaurant.result');
Route::get('/restaurants/viewmenu/{resid}','RestaurantController@ViewMenu')->name('restaurant.viewmenu');

Route::post('/restaurants/getItem','RestaurantController@getItem')->name('restaurant.getItem');
Route::post('/restaurants/getItemByCategory','RestaurantController@getItemByCategory')->name('restaurant.getItemByCategory');

Route::post('/restaurants/addCart','RestaurantController@addCart')->name('restaurant.addCart');
Route::post('/restaurants/updateitemsize','RestaurantController@updateItemSize')->name('restaurant.updateitemsize');
Route::post('/restaurants/updateitemqty','RestaurantController@updateItemQty')->name('restaurant.updateitemqty');

//checkout
Route::get('/restaurants/checkout/','RestaurantController@checkout')->name('restaurant.checkout');
Route::post('/restaurants/submitorder','RestaurantController@SubmitOrder')->name('restaurant.submitorder');



//set session
Route::post('/restaurants/takeout','RestaurantController@takeout')->name('restaurant.takeout');
Route::post('/restaurants/delivery','RestaurantController@delivery')->name('restaurant.delivery');
Route::post('/restaurants/cash','RestaurantController@Cash')->name('restaurant.cash');
Route::post('/restaurants/card','RestaurantController@Card')->name('restaurant.card');


//Route::view('/admin','admin.index')->name('admin.index');
