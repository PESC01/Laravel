<?php

namespace Database\Seeders;

use App\Models\AntecedentesMedicos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AntecedentesMedicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $antecedente = new AntecedentesMedicos();
        $antecedente->enfermedades_cronicas = "Enfermedades del paciente";
        $antecedente->alergias_medicamentos = "Alergias a medicamentos";
        $antecedente->cirugias_previas = "Cirugias realizadas anteriormente";
        $antecedente->historial_enfermedades = "Enfermedades";
        $antecedente->persona = "1";
        $antecedente->save();
    }
}
