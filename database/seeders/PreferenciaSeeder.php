<?php

namespace Database\Seeders;

use App\Models\Preferencia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreferenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $preferencia = new Preferencia;
        $preferencia->preferencias_alimenticias = "Puras comidas blancas";
        $preferencia->preferencias_habitacion = "Temperatura templada ";
        $preferencia->necesidades_especiales = "Baño privado";
        $preferencia->persona = "1";
        $preferencia->save();
    }
}
