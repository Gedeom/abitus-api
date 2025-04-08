<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PessoaController,
    PessoaEnderecoController,
    LotacaoController,
    UnidadeController,
    UnidadeEnderecoController,
    ServidorTemporarioController,
    ServidorEfetivoController,
    EnderecoController,
    CidadeController,
    FotoController,
    AuthController
};
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

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['api', 'auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::resource('pessoas', PessoaController::class);
    Route::resource('pessoas-enderecos', PessoaEnderecoController::class);
    Route::resource('lotacoes', LotacaoController::class);
    Route::get('lotacoes/unidade/{unid_id}', [LotacaoController::class, 'showByUnidade']);
    Route::resource('unidades', UnidadeController::class);
    Route::resource('unidades-enderecos', UnidadeEnderecoController::class);
    Route::resource('servidores-temporarios', ServidorTemporarioController::class);
    Route::resource('servidores-efetivos', ServidorEfetivoController::class);
    Route::get('servidores-efetivos/name/{pes_nome}', [ServidorEfetivoController::class, 'getByName']);
    Route::resource('enderecos', EnderecoController::class);
    Route::resource('cidades', CidadeController::class);
    Route::resource('fotos', FotoController::class)->only(['store', 'destroy', 'show']);
});

Route::fallback(function () {
    return response()->json([
        'message' => 'Rota não encontrada. Verifique a documentação da API.'
    ], 404);
});
