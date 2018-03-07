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
Route::view('/restaurants','restaurants.index')->name('restaurant.result');
Route::view('/restaurants/profile','restaurants.profile')->name('restaurant.profile');
Route::view('/contact','contact')->name('contact');
Route::view('/registration','registration')->name('registration');
Route::view('/checkout','checkout')->name('checkout');
Route::view('/admin','admin.index')->name('admin.index');
