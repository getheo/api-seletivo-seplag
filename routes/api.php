<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FotoPessoaController;
use App\Http\Controllers\LotacaoController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\ServidorEfetivoController;
use App\Http\Controllers\ServidorTemporarioController;
use App\Http\Controllers\UnidadeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

    /* Rotas para as Pessoas */
    //Route::apiResource('pessoas', [PessoaController::class, 'index']);    

});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    //Route::apiResource('pessoas', PessoaController::class);

    /* Rotas para as Pessoas */
    Route::get('pessoa', [PessoaController::class, 'index']);
    Route::post('pessoa', [PessoaController::class, 'store']);
    Route::get('pessoa/{pessoa}', [PessoaController::class, 'show']);
    Route::put('pessoa/{pessoa}', [PessoaController::class, 'update']);
    Route::delete('pessoa/{pessoa}', [PessoaController::class, 'destroy']);

    /* Rotas para as Unidades */
    Route::get('unidade', [UnidadeController::class, 'index']);
    Route::post('unidade', [UnidadeController::class, 'store']);
    Route::get('unidade/{unidade}', [UnidadeController::class, 'show']);
    Route::put('unidade/{unidade}', [UnidadeController::class, 'update']);
    Route::delete('unidade/{unidade}', [UnidadeController::class, 'destroy']);

    /* Rotas para as Lotações */
    Route::get('lotacao', [LotacaoController::class, 'index']);
    Route::post('lotacao', [LotacaoController::class, 'store']);
    Route::get('lotacao/{lotacao}', [LotacaoController::class, 'show']);
    Route::put('lotacao/{lotacao}', [LotacaoController::class, 'update']);
    Route::delete('lotacao/{lotacao}', [LotacaoController::class, 'destroy']);

    /* Rotas para as Servidor Temporario */
    Route::get('servidor-temporario', [ServidorTemporarioController::class, 'index']);
    Route::post('servidor-temporario', [ServidorTemporarioController::class, 'store']);
    Route::get('servidor-temporario/{servidor-temporario}', [ServidorTemporarioController::class, 'show']);
    Route::put('servidor-temporario/{servidor-temporario}', [ServidorTemporarioController::class, 'update']);
    Route::delete('servidor-temporario/{servidor-temporario}', [ServidorTemporarioController::class, 'destroy']);

    /* Rotas para as Servidor Efetivo */
    Route::get('servidor-efetivo', [ServidorEfetivoController::class, 'index']);
    Route::post('servidor-efetivo', [ServidorEfetivoController::class, 'store']);
    Route::get('servidor-efetivo/{servidorefetivo}', [ServidorEfetivoController::class, 'show']);
    Route::put('servidor-efetivo/{servidorefetivo}', [ServidorEfetivoController::class, 'update']);
    Route::delete('servidor-efetivo/{servidorefetivo}', [ServidorEfetivoController::class, 'destroy']);


    /* Rotas para as Foto Pessoa */
    Route::get('foto-pessoa', [FotoPessoaController::class, 'index']);
    Route::post('foto-pessoa', [FotoPessoaController::class, 'store']);
    Route::get('foto-pessoa/{foto-pessoa}', [FotoPessoaController::class, 'show']);
    Route::put('foto-pessoa/{foto-pessoa}', [FotoPessoaController::class, 'update']);
    Route::delete('foto-pessoa/{foto-pessoa}', [FotoPessoaController::class, 'destroy']);

    Route::apiResource('files', FileController::class);

});



