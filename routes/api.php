<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FotoPessoaController;
use App\Http\Controllers\LotacaoController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\ServidorEfetivoController;
use App\Http\Controllers\ServidorTemporarioController;
use App\Http\Controllers\UnidadeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user(); 
    Route::apiResource('pessoas', [PessoaController::class, 'index']);
});
*/

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    //Route::apiResource('pessoas', PessoaController::class);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);

    /* Rotas para as Cidades */
    Route::get('cidade', [CidadeController::class, 'index']);
    Route::post('cidade', [CidadeController::class, 'store']);
    Route::get('cidade/{cid_id}', [CidadeController::class, 'show']);
    Route::put('cidade/{cid_id}', [CidadeController::class, 'update']);
    Route::delete('cidade/{cid_id}', [CidadeController::class, 'destroy']);

    /* Rotas para as Pessoas */
    Route::get('pessoa', [PessoaController::class, 'index']);
    Route::post('pessoa', [PessoaController::class, 'store']);
    Route::get('pessoa/{pes_id}', [PessoaController::class, 'show']);
    Route::put('pessoa/{pes_id}', [PessoaController::class, 'update']);
    Route::delete('pessoa/{pes_id}', [PessoaController::class, 'destroy']);

    /* Rotas para as Endereços */
    Route::get('endereco', [EnderecoController::class, 'index']);
    Route::post('endereco', [EnderecoController::class, 'store']);
    Route::get('endereco/{end_id}', [EnderecoController::class, 'show']);
    Route::put('endereco/{end_id}', [EnderecoController::class, 'update']);
    Route::delete('endereco/{end_id}', [EnderecoController::class, 'destroy']);

    /* Rotas para as Unidades */
    Route::get('unidade', [UnidadeController::class, 'index']);
    Route::post('unidade', [UnidadeController::class, 'store']);
    Route::get('unidade/{unid_id}', [UnidadeController::class, 'show']);
    Route::put('unidade/{unid_id}', [UnidadeController::class, 'update']);
    Route::delete('unidade/{unid_id}', [UnidadeController::class, 'destroy']);

    /* Rotas para as Lotações */
    Route::get('lotacao', [LotacaoController::class, 'index']);
    Route::post('lotacao', [LotacaoController::class, 'store']);
    Route::get('lotacao/{lot_id}', [LotacaoController::class, 'show']);
    Route::get('lotacao/unidade/{unid_id}', [LotacaoController::class, 'showUnidade']);
    Route::put('lotacao/{lot_id}', [LotacaoController::class, 'update']);
    Route::delete('lotacao/{lot_id}', [LotacaoController::class, 'destroy']);

    /* Rotas para as Servidor Temporario */
    Route::get('servidor-temporario', [ServidorTemporarioController::class, 'index']);
    Route::post('servidor-temporario', [ServidorTemporarioController::class, 'store']);
    Route::get('servidor-temporario/{pes_id}', [ServidorTemporarioController::class, 'show']);
    Route::put('servidor-temporario/{pes_id}', [ServidorTemporarioController::class, 'update']);
    Route::delete('servidor-temporario/{pes_id}', [ServidorTemporarioController::class, 'destroy']);

    /* Rotas para as Servidor Efetivo */
    Route::get('servidor-efetivo', [ServidorEfetivoController::class, 'index']);
    Route::post('servidor-efetivo', [ServidorEfetivoController::class, 'store']);
    Route::get('servidor-efetivo/{pes_id}', [ServidorEfetivoController::class, 'show']);
    Route::put('servidor-efetivo/{pes_id}', [ServidorEfetivoController::class, 'update']);
    Route::delete('servidor-efetivo/{pes_id}', [ServidorEfetivoController::class, 'destroy']);


    /* Rotas para as Foto Pessoa */
    Route::get('foto-pessoa', [FotoPessoaController::class, 'index']);
    Route::post('foto-pessoa', [FotoPessoaController::class, 'store']);
    Route::get('foto-pessoa/{fp_id}', [FotoPessoaController::class, 'show']);
    Route::put('foto-pessoa/{fp_id}', [FotoPessoaController::class, 'update']);
    Route::delete('foto-pessoa/{fp_id}', [FotoPessoaController::class, 'destroy']);

    Route::apiResource('files', FileController::class);

});



