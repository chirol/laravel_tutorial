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

Route::get('/', 'TaskController@index')->name('index');
Route::get('/create', 'TaskController@showCreateForm')->name('create');
Route::post('/create', 'TaskController@create');
Route::get('/{id}/edit', 'TaskController@showEditForm')->name('edit');
Route::post('/{id}/edit', 'TaskController@edit');
Route::delete('/{id}/delete', 'TaskController@destroy')->name('delete');
Route::get('/{id}', 'TaskController@show')->name('show');
