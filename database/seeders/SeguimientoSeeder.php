<?php

namespace Database\Seeders;

use App\Models\Seguimiento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeguimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seguimiento = new Seguimiento();
        $seguimiento->presion_arterial = "43.3";
        $seguimiento->frecuencia_cardiaca  = "12";
        $seguimiento->temperatura  = "32";
        $seguimiento->fecha_seguimiento = "2023-10-10";
        $seguimiento->persona = "1";
        $seguimiento->save();
    }
}
