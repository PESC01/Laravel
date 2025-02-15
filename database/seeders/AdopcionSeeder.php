<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Adoptante;
use App\Models\Adopcion;


class AdopcionSeeder extends Seeder
{
    public function run(): void
    {
        $adopcion = new Adopcion;
        $adopcion->fecha = "2023-10-10";
        $adopcion->adoptante = "1";
        $adopcion->persona = "1";
        $adopcion->motivo = "Motivo desconocido";
        $adopcion->estado = "Pendiente";
        $adopcion->observaciones = "Sin observaciones";
        $adopcion->save();
    }
}
