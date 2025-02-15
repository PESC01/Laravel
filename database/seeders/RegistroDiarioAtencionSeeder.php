<?php

namespace Database\Seeders;

use App\Models\RegistroDiarioAtencion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistroDiarioAtencionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diario = new RegistroDiarioAtencion();
        $diario->actividades_paciente_descripcion = "Hoy el paciente tuvo problemas con la comida las vomitaba.";
        $diario->fecha = "2023-10-09";
        $diario->persona = "1";
        $diario->save();
    }
}
