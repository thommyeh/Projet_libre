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

Route::get('/EspacePerso', function () {
	return view('editeur')->middleware('verified');
});

Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/profil', 'HomeController@profil')->name('profil')->middleware('verified');
Route::post('/profil', 'HomeController@edit')->name('edit')->middleware('verified');
Route::get('/delete', 'HomeController@delete')->name('delete')->middleware('verified');

