<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Produto;
use App\Services\GeraEntrega;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function listaPedidos()
    {
        $clientes = Cliente::orderBy('nome')->get();

        return view('welcome', compact('clientes'));
    }

    public function novoPedido(Cliente $cliente)
    {
        $produtos = Produto::orderBy('nome')->get();

        return view('criar', compact(
            'cliente',
            'produtos'
        ));
    }

    public function salvarPedido(Request $request, Cliente $cliente)
    {
        $request->validate([
            'produto' => 'required|exists:produto,id'
        ]);

        $cliente->produtos()->attach($request->produto);

        return redirect()
            ->route('pedidos.lista')
            ->with('success', 'Pedido realizado.');


    }

    public function excluirPedido(Request $request, Cliente $cliente)
    {
        $request->validate([
            'produto' => 'required|exists:produto,id'
        ]);

        $cliente->produtos()->detach($request->produto);

        return redirect()
            ->route('pedidos.lista')
            ->with('success', 'Pedido deletado.');
    }

    public function gerarEntrega()
    {
        $teste = new GeraEntrega();

        $relatorio = $teste->gerarEntrega();

        return view('entrega', compact('relatorio'));
    }
}
