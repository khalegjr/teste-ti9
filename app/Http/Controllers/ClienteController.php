<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function listaPedidos()
    {
        $clientes = Cliente::all();

        return view('welcome', compact('clientes'));
    }

    public function gerarEntrega()
    {
        $caminhao = 0;
        $relatorio = [];

        // $clientes = Cliente::orderBy('uf')->orderBy('nome')->get();
        $clientes = Cliente::whereHas('produtos', function ($p) {
            $p->where('peso', '<', 300);
        })->orderBy('uf')->orderBy('nome')->get();
        $clientes_por_estado = $clientes->groupBy('uf');
        // dd($clientes_por_estado);
        $keys = $clientes_por_estado->keys();

        /** Formato de dados que preciso
         * uf: --
         *  cliente: 1
         *      produtos:
         *          id  nome 1
         *          id  nome 2
         *  cliente: 2
         *      produtos:
         *          id  nome 1
         */

        foreach ($keys as $key) {
                $pesoTotal = 0;
                $relatorio[$key]['clientes'] = [];
                $contador = 0;
                $caminhao += 1;
            foreach ($clientes_por_estado[$key] as $cliente) {
                $addProduto = [];

                $relatorio[$key]['clientes'][$contador] = [
                    'cliente_id' => $cliente->id,
                    'cliente_nome' => $cliente->nome
                ];

                foreach ($cliente->produtos as $produto) {
                    array_push($addProduto, [
                        "id" => $produto->id,
                        "nome" => $produto->nome,
                    ]);

                    $pesoTotal += $produto->peso;

                }
                    $relatorio[$key]['clientes'][$contador]['produtos'] = $addProduto;

                    $contador += 1;
            }
                $relatorio[$key]['peso_total'] = $pesoTotal;
                $relatorio[$key]['caminhao'] = $caminhao;
        }

        // dd($relatorio);

        return view('entrega', compact('relatorio'));
    }
}
