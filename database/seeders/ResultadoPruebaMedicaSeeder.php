<?php

namespace Database\Seeders;

use App\Models\ResultadoPruebaMedica;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResultadoPruebaMedicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prueba =new ResultadoPruebaMedica();
        $prueba->descripcion_prueba_medica = "Descripción de prueba médica";
        $prueba->fecha_prueba_medica ="2023-12-12";
        $prueba->persona = "1";
        $prueba->save();
    }
}
