<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Collection;
use PhpParser\Node\Expr\Cast\Object_;
use stdClass;

class GeraEntrega
{
    private int $contadorCaminhoes = 0;
    private float $pesoTotal = 0;

    public function gerarEntrega()
    {
        return [
            "normal" => $this->montarPrimeiraParte(),
            "especial" => $this->montarEspecial(),
        ];
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
                    'peso_total' => $this->pesoTotal
                ];
            })->reject(function ($group) {
                return $group['clientes']->isEmpty();
        })->values();

        return $clientes->sortBy('uf');
    }

    private function montarEspecial()
    {
        return "caminhões extras";
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
