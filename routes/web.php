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
    Route::get('/', 'UserController@index');
    Route::get('/editar/{id}', 'UserController@edit');
});
