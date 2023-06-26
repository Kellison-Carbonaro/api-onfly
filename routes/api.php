<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UsuariosController;
use App\Http\Controllers\API\DespesasController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', [UsuariosController::class, 'login']);
Route::apiResource('usuarios', UsuariosController::class);

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('logout', [UsuariosController::class, 'logout']);
    Route::apiResource('despesas', DespesasController::class);
});