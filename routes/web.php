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



Auth::routes(['verify' => true]);
//Fonctionnalités utilisateur
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/editeur', 'HomeController@editeur')->name('editeur')->middleware('verified');
Route::get('/profil', 'HomeController@profil')->name('profil')->middleware('verified');
Route::post('/profil', 'HomeController@edit')->name('edit')->middleware('verified');
Route::delete('/delete', 'HomeController@delete')->name('delete')->middleware('verified');
//test du renvoi en Json des event d'un user
Route::get('/test', 'HomeController@test');
//Routes surchargées du calendrier
Route::get('all-event','EventController@all_event')->name('all-event');
Route::get('event','EventController@index')->name('event');  
Route::get('event-list','EventController@event_list');   
Route::get('single-event/{id}','EventController@single_event');



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
