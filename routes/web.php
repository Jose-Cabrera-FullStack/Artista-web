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

Route::match(['get','post'],'/admin','AdminController@login');

Route::group(['middleware' => ['auth']], function(){
    Route::match(['get','post'],'/admin/dashboard','AdminController@dashboard');
    Route::get('/admin/picture','AdminController@picture'); 
    Route::match(['get','post'],'/admin/picture-add','AdminController@addPicture');
    Route::match(['get','post'],'/admin/view-picture','AdminController@viewPicture');
});

Route::get('/home', 'HomeController@index')->name('home');
