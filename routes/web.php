<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get(
    '/',
    [ClienteController::class, 'listaPedidos']
    )
->name('pedidos.lista');
Route::group([
        'prefix' => '/pedidos',
        'as' => 'pedidos.',
    ], function () {
        Route::get(
            '/entrega',
            [ClienteController::class, 'gerarEntrega']
            )
        ->name('gerar.entrega');
        Route::get(
            '/{cliente}/novo',
            [ClienteController::class, 'novoPedido']
            )
        ->name('novo');
        Route::post(
            '/salvar/{cliente}',
            [ClienteController::class, 'salvarPedido']
            )
        ->name('salvar');
        Route::delete(
            '/{cliente}/excluir',
            [ClienteController::class, 'excluirPedido']
            )
        ->name('excluir');
});
