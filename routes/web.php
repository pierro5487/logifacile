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

/*----client-----*/
Route::get('/clients/ajout','ClientsController@add')->name('clients.add');
Route::get('/clients/liste','ClientsController@liste')->name('clients.liste');
Route::post('/clients/sauve','ClientsController@sauve')->name('sauveClient');
Route::get('/clients/searchcp','ClientsController@searchCP')->name('clients.searchCP');
Route::get('/clients/edit/{client}','ClientsController@edit')->name('clients.edit')->where('client','[0-9]*');
Route::post('/clients/update/{client}','ClientsController@update')->name('client.update')->where('client','[0-9]*');

/*----code postal----*/
Route::get('/cp/search','CodePostalController@Search')->name('codePostal.search');

/*--------autos----------*/
Route::get('/autos/ajout/{client?}','AutosController@add')->name('autos.add')->where('client','[0-9]*');

/*-------modeles-----*/
Route::get('/models/getModelsForMarque','ModelsController@getModelsForMarque')->name('models.getModelsForMarque');