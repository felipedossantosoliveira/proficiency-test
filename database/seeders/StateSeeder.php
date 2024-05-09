<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('states')->insert([
            ['id' => 12, 'name' => 'Acre', 'abbreviation' => 'AC'],
            ['id' => 27, 'name' => 'Alagoas', 'abbreviation' => 'AL'],
            ['id' => 16, 'name' => 'Amapá', 'abbreviation' => 'AP'],
            ['id' => 13, 'name' => 'Amazonas', 'abbreviation' => 'AM'],
            ['id' => 29, 'name' => 'Bahia', 'abbreviation' => 'BA'],
            ['id' => 23, 'name' => 'Ceará', 'abbreviation' => 'CE'],
            ['id' => 53, 'name' => 'Distrito Federal', 'abbreviation' => 'DF'],
            ['id' => 32, 'name' => 'Espírito Santo', 'abbreviation' => 'ES'],
            ['id' => 52, 'name' => 'Goiás', 'abbreviation' => 'GO'],
            ['id' => 21, 'name' => 'Maranhão', 'abbreviation' => 'MA'],
            ['id' => 51, 'name' => 'Mato Grosso', 'abbreviation' => 'MT'],
            ['id' => 50, 'name' => 'Mato Grosso do Sul', 'abbreviation' => 'MS'],
            ['id' => 31, 'name' => 'Minas Gerais', 'abbreviation' => 'MG'],
            ['id' => 15, 'name' => 'Pará', 'abbreviation' => 'PA'],
            ['id' => 25, 'name' => 'Paraíba', 'abbreviation' => 'PB'],
            ['id' => 41, 'name' => 'Paraná', 'abbreviation' => 'PR'],
            ['id' => 26, 'name' => 'Pernambuco', 'abbreviation' => 'PE'],
            ['id' => 22, 'name' => 'Piauí', 'abbreviation' => 'PI'],
            ['id' => 33, 'name' => 'Rio de Janeiro', 'abbreviation' => 'RJ'],
            ['id' => 24, 'name' => 'Rio Grande do Norte', 'abbreviation' => 'RN'],
            ['id' => 43, 'name' => 'Rio Grande do Sul', 'abbreviation' => 'RS'],
            ['id' => 11, 'name' => 'Rondônia', 'abbreviation' => 'RO'],
            ['id' => 14, 'name' => 'Roraima', 'abbreviation' => 'RR'],
            ['id' => 42, 'name' => 'Santa Catarina', 'abbreviation' => 'SC'],
            ['id' => 35, 'name' => 'São Paulo', 'abbreviation' => 'SP'],
            ['id' => 28, 'name' => 'Sergipe', 'abbreviation' => 'SE'],
            ['id' => 17, 'name' => 'Tocantins', 'abbreviation' => 'TO'],
        ]);
    }
}
