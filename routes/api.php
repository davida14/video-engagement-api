<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::post('/items', [ApiController::class, 'createItems']);
Route::get('items', [ApiController::class, 'getAllItems']);
Route::get('items/{id}', [ApiController::class, 'getItem']);
Route::put('items/{id}', [ApiController::class, 'updateItem']);
Route::delete('items/{id}', [ApiController::class, 'deleteItem']);
Route::post('video-upload', [ApiController::class, 'testUpload']);

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
