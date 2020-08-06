<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|showの/{id}の部分でshowより上で引っかからなかったアドレスをすべて吸ってしまうことが
わかったので、一番下に置いている
*/
Auth::routes();
Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/', 'TaskController@index')->name('index');
    Route::post('/', 'TaskController@search');
    Route::get('/create', 'TaskController@showCreateForm')->name('create');
    Route::post('/create', 'TaskController@create');
    Route::get('/{id}/edit', 'TaskController@showEditForm')->name('edit');
    Route::post('/{id}/edit', 'TaskController@edit');
    Route::delete('/{id}/delete', 'TaskController@destroy')->name('delete');
    Route::get('/{id}', 'TaskController@show')->name('show');
});
