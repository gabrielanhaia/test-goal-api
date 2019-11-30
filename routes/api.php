<?php

use Illuminate\Http\Request;

Route::post('send-email', function (Illuminate\Http\Request $request) {
    $to      = 'contato@goalconstrucoes.com.br';
    $subject = 'Contato site - ' . $request->post('name');
    $message = "Nome: " . $request->post('name') . "\r\n" . "Mensagem: " . $request->post('mensagem') . "\r\n" . "Telefone: " . $request->post('phone');
	$from = $request->post('email');
    $headers = "From: {$from}" . "\r\n" .
        'Reply-To: contato@goalconstrucoes.com.br' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);
});


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

Route::post('login', 'ApiLoginController@login');

// Rotas do Editor (Fine Upload)
Route::post('images', 'Admin\ImageController@upload');
Route::delete('images/{id}', 'Admin\ImageController@delete');
Route::get('images/{album_id}', 'Admin\ImageController@listByAlbum');


Route::prefix('albuns')->group(function () {
    Route::get('/', 'Admin\AlbumController@listAlbumsSiteApi');
    Route::get('/{id}', 'Admin\AlbumController@openAlbumSiteApi');
});

Route::middleware('auth.jwt')->prefix('projects')->group(function () {
    Route::get('/', 'Admin\ProjectController@list');
    Route::get('/{id}/albums', 'Admin\ProjectController@listAlbumsProject');
    Route::get('/{id}/albums/{id_album}', 'Admin\ProjectController@listPhotosAlbumsProject');
});

