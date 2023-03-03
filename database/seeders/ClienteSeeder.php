<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::truncate();

        $csvFile = fopen(base_path("database/data/lista-clientes-ti9.csv"), "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ";")) !== false) {
            if (!$firstline) {
                Cliente::create([
                    "nome" => $data['0'],
                    "uf" => $data['1'],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
