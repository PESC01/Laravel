<?php

namespace Database\Seeders;

use App\Models\HistorialMedicamentos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistorialMedicamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $historial = new HistorialMedicamentos();
        $historial->medicamentos = "2";
        $historial->medicamentos_anteriores_recetados = "Parcetamol, etc";
        $historial->dosis_duracion_medicacion = "dias muchos dias";
        $historial->persona = "1";
        $historial->save();
        
    }
}
