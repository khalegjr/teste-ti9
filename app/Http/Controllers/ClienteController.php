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
        // dd($produtos);
        return view('criar', compact(
            'cliente',
            'produtos'
        ));
    }

    public function store(Request $request, Cliente $cliente)
    {
        $request->validate([
            'produto' => 'required|exists:produto,id'
        ]);

        // dd($cliente);

        // $cliente->produtos()->attach($request->produto);

        return redirect()
            ->route('pedidos.lista')
            ->with('success', 'Pedido realizado.');

        //             $pesoTotal += $produto->peso;

    }

        //             $contador += 1;
        //     }
        //         $relatorio[$key]['peso_total'] = $pesoTotal;
        //         $relatorio[$key]['caminhao'] = $caminhao;
        // }

        // dd($relatorio);

        return view('entrega', compact('relatorio'));
    }
}
