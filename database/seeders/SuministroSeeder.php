<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SuministroSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('suministros')->insert([
                'nombre' => $faker->word,
                'descripcion' => $faker->sentence,
                'cantidad' => $faker->numberBetween(1, 100),
                'tipo' => $faker->numberBetween(1, 9), // Tipo entre 1 y 9
                'proveedor' => 1, // Siempre 1 para el proveedor
            ]);
        }
    }
}
