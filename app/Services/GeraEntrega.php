<?php

namespace App\Services;

use App\Models\Cliente;

class GeraEntrega
{
    private int $contadorCaminhoes = 0;
    private float $pesoTotal = 0;

    public function gerarEntrega()
    {
        return (object) [
            "normal" => $this->montarPrimeiraParte(),
            "especial" => $this->montarEspecial(),
        ];
    }

    private function montarPrimeiraParte() {
        $clientes = Cliente::with([
            'produtos' => function ($query) {
            $query->where('peso', '<', 300);
        }])
            ->get()
            ->groupBy('uf')
            ->map(function ($group) {
                $this->pesoTotal = 0;
                return [
                    'uf' => $group->first()->uf,
                    'caminhao' => $this->somarCaminhoes(),
                    'clientes' => $group->map(function ($cliente) {
                        return $this->montarCliente($cliente);
                    })->reject(function ($cliente) {
                        return $cliente['produtos']->isEmpty();
                    }),
                    'peso_total' => number_format($this->pesoTotal, 3, ',', '.')
                ];
            })->reject(function ($group) {
                return $group['clientes']->isEmpty();
        })->values();

        return $clientes->sortBy('uf');
    }

    private function montarEspecial()
    {
        $clientes = Cliente::whereHas('produtos', function($query) {
            $query->where('peso', '>=', 300);
        })->with([
            'produtos' => function ($query) {
            $query->where('peso', '>=', 300);
        }])
            ->get();

        $clientes->sortBy('uf');

        $clientes = $clientes->map(function ($cliente) {
            $this->pesoTotal = 0;
            return [
                'uf' => $cliente->uf,
                'caminhao' => $this->somarCaminhoes(),
                'clientes' => [$this->montarCliente($cliente)],
                'peso_total' => number_format($this->pesoTotal, 3, ',', '.'),
            ];
        });

        return $clientes->sortBy('uf');
    }

    private function montarCliente($cliente)
    {
        return [
            'id' => $cliente->id,
            'nome' => $cliente->nome,
            'produtos' => $cliente->produtos
                ->map(function ($produto) {
                    $this->somarPeso($produto->peso);
                    return $this->montarProduto($produto);
                })
        ];
    }

    private function montarProduto($produto)
    {
        return [
            'id' => $produto->id,
            'nome' => $produto->nome,
            'peso' => $produto->peso
        ];
    }

    private function somarCaminhoes(): int
    {
        $this->contadorCaminhoes += 1;

        return $this->contadorCaminhoes;
    }

    private function somarPeso(float $peso): void
    {
        $this->pesoTotal += $peso;
    }
}
