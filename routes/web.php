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
Route::get('/clients/upload/','ClientsController@upload')->name('clients.upload');
Route::post('/clients/upload/','ClientsController@upload')->name('clients.upload');
Route::get('/clients/view/{client}','ClientsController@view')->name('clients.view')->where('client','[0-9]*');
Route::get('/clients/getClients','ClientsController@getClients')->name('clients.getClients');

/*----code postal----*/
//Route::get('/cp/search','CodePostalController@Search')->name('codePostal.search');
Route::post('/cp/add','CpController@add')->name('cps.add');

/*--------autos----------*/
Route::get('/autos/ajout/{client?}','AutosController@add')->name('autos.add')->where('client','[0-9]*');
Route::post('/autos/sauve','AutosController@sauve')->name('autos.sauve');
Route::get('/autos/','AutosController@index')->name('autos.index');
Route::get('/autos/edit/{auto}','AutosController@edit')->name('autos.edit')->where('auto','[0-9]*');
Route::post('/autos/update/{auto}','AutosController@update')->name('auto.update')->where('auto','[0-9]*');
Route::get('/autos/searchauto','AutosController@searchAuto')->name('autos.searchAuto');
Route::get('/autos/upload/','AutosController@upload')->name('autos.upload');
Route::post('/autos/upload/','AutosController@upload')->name('autos.upload');

/*-------modeles-----*/
Route::get('/modeles/getModelesForMarque','ModelesController@getModelesForMarque')->name('models.getModelesForMarque');

/*------montages-----*/
Route::get('/montages/ajout','MontagesController@add')->name('montages.add');
Route::get('/montages/config','MontagesController@config')->name('montages.config');
Route::post('/montages/update','MontagesController@update')->name('montages.update');


/*-----factures-----*/
Route::get('/factures','FacturesController@index')->name('factures.index');
Route::get('/factures/ajout/{client?}','FacturesController@add')->name('factures.add')->where('client','[0-9]*');
Route::get('/factures/visualise/{facture}','FacturesController@visualise')->name('factures.visualise')->where('facture','[0-9]*');
Route::get('/factures/edit/{facture}','FacturesController@edit')->name('factures.edit')->where('facture','[0-9]*');
Route::post('/factures/delete/{facture}','FacturesController@delete')->name('factures.delete')->where('facture','[0-9]*');
Route::post('/factures/valide/{facture}','FacturesController@valide')->name('factures.valide')->where('facture','[0-9]*');
Route::get('/factures/forcecreationfacture}','FacturesController@forceCreateFacture')->name('factures.forceCreateFacture');

/*----reglement----*/
Route::get('/reglements/ajout/{facture}','ReglementsController@ajout')->name('reglements.ajout')->where('facture','[0-9]*');

/*----lignefacture-----*/
Route::post('/ligneFactures/addDecalaminage','LigneFacturesController@addDecalaminage')->name('ligneFactures.addDecalaminage');
Route::post('/ligneFactures/addCustomLigne','LigneFacturesController@addCustomLigne')->name('ligneFactures.addCustomLigne');
Route::post('/ligneFactures/addMontage','LigneFacturesController@addMontage')->name('ligneFactures.addMontage');
Route::post('/ligneFactures/deleteLigne','LigneFacturesController@deleteLigne')->name('ligneFactures.deleteLigne');
Route::post('/ligneFactures/updateLigne','LigneFacturesController@updateLigne')->name('ligneFactures.updateLigne');

/*---grouppeLigne-------*/
Route::post('/groupeLignes/deleteHeader','GroupeLignesController@deleteHeader')->name('groupeLignes.deleteHeader');
Route::post('/groupeLignes/addAutoHeader','GroupeLignesController@addAutoHeader')->name('groupeLignes.addAutoHeader');
Route::post('/groupeLignes/addNewGroupe/{facture}','GroupeLignesController@addNewGroupe')->name('groupeLignes.addNewGroupe')->where('facture','[0-9]*');
Route::post('/groupeLignes/deleteGroupe/{groupe}','GroupeLignesController@deleteGroupe')->name('groupeLignes.deleteGroupe')->where('groupe','[0-9]*');

/*-----reglement------*/
Route::get('/reglements/add/{facture}','ReglementsController@add')->name('reglements.add')->where('facture','[0-9]*');
Route::post('/reglements/create/{facture}','ReglementsController@create')->name('reglements.create')->where('facture','[0-9]*');

/*-----marques--------*/
Route::get('/marques/index/','MarquesController@index')->name('marques.index');
Route::get('/marques/edit/{marque}','MarquesController@edit')->name('marques.edit')->where('marques','[0-9]*');
Route::post('/marques/edit/{marque}','MarquesController@edit')->name('marques.edit')->where('marques','[0-9]*');
Route::get('/marques/add/','MarquesController@add')->name('marques.add');
Route::post('/marques/create/','MarquesController@create')->name('marques.create');
Route::get('/marques/upload/','MarquesController@upload')->name('marques.upload');
Route::post('/marques/upload/','MarquesController@upload')->name('marques.upload');

/*-----modeles--------*/
Route::get('/modeles/index/','ModelesController@index')->name('modeles.index');
Route::get('/modeles/edit/{modele}','ModelesController@edit')->name('modeles.edit')->where('modele','[0-9]*');
Route::post('/modeles/update/{modele}','ModelesController@update')->name('modeles.update')->where('modele','[0-9]*');
Route::get('/modeles/add/','ModelesController@add')->name('modeles.add');
Route::post('/modeles/create/','ModelesController@create')->name('modeles.create');
Route::get('/modeles/upload/','ModelesController@upload')->name('modeles.upload');
Route::post('/modeles/upload/','ModelesController@upload')->name('modeles.upload');

/*-----configutration-------*/
//Route::post('/configurations/montage/','ConfigurationsController@montage')->name('configurations.montage');
