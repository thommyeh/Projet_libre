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
Route::get('/RGPD', 'HomeController@RGPD')->name('RGPD');
Route::get('/legals', 'HomeController@legals')->name('legals');
Route::get('/profil', 'HomeController@profil')->name('profil')->middleware('verified');
Route::post('/profil', 'HomeController@edit')->name('edit')->middleware('verified');
Route::delete('/delete', 'HomeController@delete')->name('delete')->middleware('verified');
Route::get('profileAccount', 'HomeController@profileAccount')->name('profile')->middleware('verified');
Route::get('pageProfil', 'HomeController@pageProfil')->name('pageProfil')->middleware('verified');

//editeur de personnages
Route::get('/editeur', 'DesignerController@editeur')->name('editeur')->middleware('verified');
Route::post('/editeur', 'DesignerController@store')->name('save_character')->middleware('verified');
 Route::post('/avatar', 'DesignerController@uploadAvatar')->name('avatar')->middleware('verified');

//Routes surchargées du gestionnaire d'evenements
Route::get('all-event', 'EventController@all_event')->name('all-event');
Route::get('event', 'EventController@index')->name('event');
Route::get('event-list', 'EventController@event_list')->middleware('verified');;
Route::get('single-event/{id}', 'EventController@single_event')->middleware('verified');;

//Espace Admin
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

//Flux Rss
Route::get('/rss', 'RssController@urls')->name('rss')->middleware('verified');;
Route::get('/rssfiltre', 'RssController@filtres')->name('rssfiltre')->middleware('verified');;

//Routes appelées par Axios dans le app.js
Route::get('/urldata', 'RssController@urlData')->middleware('verified');;
Route::get('/filterdata', 'RssController@filtersData')->middleware('verified');;
Route::post('/newurl', 'RssController@newUrl')->name('create')->middleware('verified');
Route::post('/createfilter', 'RssController@createFilter')->name('createFilters')->middleware('verified');
Route::post('/flux/delete', 'RssController@deleteflux')->name('deleteflux')->middleware('verified');;
Route::post('/filter/delete', 'RssController@deletefilter')->name('deletefilter')->middleware('verified');

//Envoi des données au fichier Json
Route::get('/synchro', 'RssController@synchro')->name('synchro')->middleware('verified');

//Gestion de la connexion par reseau social
 Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
 Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
 
 //Gestion des avatars
 Route::post('/deleteCharacter/{id}', 'HomeController@deleteCharacter')->name('delete_character')->middleware('verified');
 Route::post('/useCharacter/{id}', 'HomeController@useCharacter')->name('use_character')->middleware('verified');
 Route::post('/chooseCharacter/{id}', 'HomeController@chooseCharacter')->name('choose_character')->middleware('verified');

