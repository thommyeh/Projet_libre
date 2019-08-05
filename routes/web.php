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
Route::post('/editeur', 'DesignerController@store')->name('save_character')->middleware('verified');
Route::get('/profil', 'HomeController@profil')->name('profil')->middleware('verified');
Route::post('/profil', 'HomeController@edit')->name('edit')->middleware('verified');
Route::delete('/delete', 'HomeController@delete')->name('delete')->middleware('verified');
Route::get('profileAccount', 'HomeController@profileAccount')->name('profile')->middleware('verified');
Route::get('pageProfil', 'HomeController@pageProfil')->name('pageProfil')->middleware('verified');
//test du renvoi en Json des event d'un user
Route::get('/profildata', 'HomeController@ProfilData')->middleware('verified');



//Routes surchargées du calendrier
Route::get('all-event', 'EventController@all_event')->name('all-event');
Route::get('event', 'EventController@index')->name('event');
Route::get('event-list', 'EventController@event_list')->middleware('verified');;
Route::get('single-event/{id}', 'EventController@single_event')->middleware('verified');;
//Espace Admin
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
//Flux Rss
Route::get('/rss', 'RssController@index')->name('rss')->middleware('verified');;
//Routes appelées par Axios dans le app.js
Route::get('/rssdata', 'RssController@RssData')->middleware('verified');;
Route::get('/filterdata', 'RssController@FiltersData')->middleware('verified');;
Route::post('/CreateRss', 'RssController@createRss')->name('create')->middleware('verified');
Route::post('/CreateFilter', 'RssController@createFilter')->name('createFilters')->middleware('verified');
Route::post('/flux/delete', 'RssController@deleteflux')->name('deleteflux')->middleware('verified');;
Route::post('/filter/delete', 'RssController@deletefilter')->name('deletefilter')->middleware('verified');
Route::get('/generate', 'RssController@GenerateData')->middleware('verified');
Route::get('/synchro', 'RssController@Synchro')->name('synchro')->middleware('verified');

 Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
 Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
 Route::post('/deleteCharacter/{id}', 'HomeController@deleteCharacter')->name('delete_character')->middleware('verified');
 Route::post('/useCharacter/{id}', 'HomeController@useAvatar')->name('use_character')->middleware('verified');
 Route::post('/avatar/{imgBase64}', 'DesignerController@uploadAvatar')->name('avatar')->middleware('verified');
