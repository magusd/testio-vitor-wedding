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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'albums'],function(){
    Route::get('/','AlbumsController@index')->name('albums');
    Route::get('/create','AlbumsController@create')->name('albums.create');
    Route::post('/','AlbumsController@store')->name('albums.store');
    Route::get('/{id}','AlbumsController@show')->name('albums.show');
    Route::get('/{id}/edit','AlbumsController@edit')->name('albums.edit');
    Route::put('/{id}','AlbumsController@update')->name('albums.update');
    Route::get('/{id}/delete','AlbumsController@deleteWarning')->name('albums.delete.warning');
    Route::delete('/{id}','AlbumsController@delete')->name('albums.delete');

    Route::get('/{id}/upload','AlbumsPhotosController@upload')->name('albums.photos.create');
    Route::post('/{id}/photos','AlbumsPhotosController@store')->name('albums.photos.store');
});
