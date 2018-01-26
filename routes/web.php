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
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/','HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

/*----client-----*/
Route::get('/clients/ajout/','ClientsController@add')->name('clients.add');
Route::get('/clients/choixClient/{redirect?}','ClientsController@choixClient')->name('clients.choixClient');
Route::post('/clients/choixClient/{redirect?}','ClientsController@choixClient')->name('clients.choixClient');
Route::get('/clients/liste','ClientsController@liste')->name('clients.liste');
Route::post('/clients/sauve','ClientsController@sauve')->name('sauveClient');
Route::get('/clients/searchcp','ClientsController@searchCP')->name('clients.searchCP');
Route::get('/clients/edit/{client}','ClientsController@edit')->name('clients.edit')->where('client','[0-9]*');
Route::post('/clients/update/{client}','ClientsController@update')->name('client.update')->where('client','[0-9]*');
Route::get('/autos/searchclient','ClientsController@searchClient')->name('autos.searchClient');

/*----code postal----*/
Route::get('/cp/search','CodePostalController@Search')->name('codePostal.search');

/*--------autos----------*/
Route::get('/autos/ajout/{client?}','AutosController@add')->name('autos.add')->where('client','[0-9]*');
Route::post('/autos/sauve','AutosController@sauve')->name('autos.sauve');
Route::get('/autos/','AutosController@index')->name('autos.index');
Route::get('/autos/edit/{auto}','AutosController@edit')->name('autos.edit')->where('auto','[0-9]*');
Route::post('/autos/update/{auto}','AutosController@update')->name('auto.update')->where('auto','[0-9]*');
Route::get('/autos/searchauto','AutosController@searchAuto')->name('autos.searchAuto');

/*-------modeles-----*/
Route::get('/modeles/getModelesForMarque','ModelesController@getModelesForMarque')->name('models.getModelesForMarque');

/*------montages-----*/
Route::get('/montages/ajout','MontagesController@add')->name('montages.add');

/*-----factures-----*/
Route::get('/factures','FacturesController@index')->name('factures.index');
Route::get('/factures/ajout/{client?}','FacturesController@add')->name('factures.add')->where('client','[0-9]*');
Route::get('/factures/visualise/{facture}','FacturesController@visualise')->name('factures.visualise')->where('facture','[0-9]*');
Route::get('/factures/edit/{facture}','FacturesController@edit')->name('factures.edit')->where('facture','[0-9]*');
Route::post('/factures/delete/{facture}','FacturesController@delete')->name('factures.delete')->where('facture','[0-9]*');

/*----reglement----*/
Route::get('/reglements/ajout/{facture}','ReglementsController@ajout')->name('reglements.ajout')->where('facture','[0-9]*');