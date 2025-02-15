<?php

namespace Database\Seeders;

use App\Models\Incidente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncidenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $incidente =new Incidente();
        $incidente->incidente_fecha = "2023-10-12";
        $incidente->incidente_descripcion = "Descripcion de incidente";
        $incidente->persona = "1";
        $incidente->save();
    }
}
