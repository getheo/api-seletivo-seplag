<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\ServidorEfetivoController;
use App\Http\Controllers\ServidorTemporarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::apiResource('pessoas', PessoaController::class);

Route::get('pessoas', [PessoaController::class, 'index']);
Route::post('pessoas', [PessoaController::class, 'store']);
Route::get('pessoas/{pessoa}', [PessoaController::class, 'show']);
Route::put('pessoas/{pessoa}', [PessoaController::class, 'update']);
Route::delete('pessoas/{pessoa}', [PessoaController::class, 'destroy']);


Route::get('pessoas/servidortemporario', [ServidorTemporarioController::class, 'index']);
Route::get('pessoas/servidorefetivo', [ServidorEfetivoController::class, 'index']);

Route::apiResource('files', FileController::class);