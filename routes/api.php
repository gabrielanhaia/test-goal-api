<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Rotas do Editor (Fine Upload)
Route::post('images', 'Admin\ImageController@upload');
Route::delete('images/{id}', 'Admin\ImageController@delete');
Route::get('images/{album_id}', 'Admin\ImageController@listByAlbum');


Route::prefix('albuns')->group(function () {
    Route::get('/', 'Admin\AlbumController@listAlbumsSiteApi');
    Route::get('/{id}', 'Admin\AlbumController@openAlbumSiteApi');
});