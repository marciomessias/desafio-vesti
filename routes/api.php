<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Produto\ProdutoController;
use App\Http\Controllers\Produto\VariacaoController;

Route::post('/produtos', [ProdutoController::class, 'cadastrarProdutos']);
Route::post('/variacoes', [VariacaoController::class, 'cadastrarVariacoes']);
