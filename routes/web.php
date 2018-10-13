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

Route::get('/', 'Admin\HomeController@index')->name('home');
Auth::routes();

Route::get('/auth', 'HomeController@index');

Route::prefix('usuarios')->group(function () {
    Route::get('/', 'Admin\UserController@index');
    Route::get('/editar/{id}', 'Admin\UserController@edit');
    Route::put('/editar/{id}', 'Admin\UserController@update');
    Route::get('/cadastrar', 'Admin\UserController@create');
    Route::post('/cadastrar', 'Admin\UserController@save');
    Route::delete('/deletar/{id}', 'Admin\UserController@delete');
});

Route::prefix('projetos')->group(function () {
    Route::get('/', 'Admin\ProjectController@index');
    Route::get('/editar/{id}', 'Admin\ProjectController@edit');
    Route::put('/editar/{id}', 'Admin\ProjectController@update');
    Route::get('/cadastrar', 'Admin\ProjectController@create');
    Route::post('/cadastrar', 'Admin\ProjectController@save');

    Route::prefix('{id}/albuns')->group(function () {
        Route::get('/', 'Admin\AlbumController@index');
        Route::get('/o/{id_album}', 'Admin\AlbumController@index');
    });
});
