<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produto::truncate();

        $csvFile = fopen(base_path("database/data/lista-produtos-ti9.csv"), "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 2000, ";")) !== false) {
            if (!$firstline) {
                Produto::create([
                    "nome" => $data['0'],
                    "peso" => $data['1'],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
