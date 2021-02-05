<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/admin', 'LivreController@showAdminDashboard')->name('showAdminDashboard');
Route::get('admin/livres/{id?}', 'LivreController@showAdminLivres')->name('showAdminLivres');
Route::post('/livres/add', 'LivreController@handleAddLivre')->name('handleAddLivre');
Route::get('/media', 'LivreController@showAdminMedia')->name('showAdminMedia');
Route::get('/delete/{id}', 'LivreController@destroy')->name('destroy');
Route::post('edit/{id}','LivreController@edit')->name('edit');
Route::get('/logout','LivreController@logout')->name('logout');
Route::get('admin/clients/{id?}', 'LivreController@showAdminClients')->name('showAdminClients');
Route::post('/clients/add', 'LivreController@handleAddClient')->name('handleAddClient');
Route::get('/delete/client/{id}', 'LivreController@destroyclt')->name('destroyclt');
Route::post('/client/{id}','LivreController@editclt')->name('editclt');
Route::get('/deletmedia/{id}', 'LivreController@DeleteLivreMedia')->name('DeleteLivreMedia');



/// api
Route::post('livres', 'LivreController@showLivres');
