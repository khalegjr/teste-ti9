<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Lista1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientes = Cliente::all();

        $csvFile = fopen(base_path("database/data/lista-produtos-escolhidos-ti9.csv"), "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ";")) !== false) {
            if (!$firstline) {
                foreach ($clientes as $cliente) {
                    if ($cliente->id == $data['0']) {
                        $cliente->products()->attach([$data['1']]);
                    }
                }
                // para cada cliente, enquanto id = cliente_id
                // sync com a tabela
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
