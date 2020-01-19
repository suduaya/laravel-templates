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

// for testing middleware
Route::get('/admin', function(){
  return "admin zone";
})->middleware(['auth.admin']);



Route::resource('/users', 'Admin\\UserController', ['except' => ['show', 'create', 'store']])->middleware(['auth', 'auth.admin']);
