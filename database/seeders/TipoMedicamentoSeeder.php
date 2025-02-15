<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoMedicamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiposMedicamentos = [
            ['nombre_medicamento' => 'Analgésicos', 'descripcion' => 'Alivian el dolor'],
            ['nombre_medicamento' => 'Antibióticos', 'descripcion' => 'Tratan infecciones bacterianas'],
            ['nombre_medicamento' => 'Antivirales', 'descripcion' => 'Combaten infecciones virales'],
            ['nombre_medicamento' => 'Antiinflamatorios no esteroides (AINE)', 'descripcion' => 'Reducen la inflamación y alivian el dolor'],
            ['nombre_medicamento' => 'Antidepresivos', 'descripcion' => 'Tratan la depresión y otros trastornos del estado de ánimo'],
            ['nombre_medicamento' => 'Antipsicóticos', 'descripcion' => 'Tratan trastornos psicóticos y esquizofrenia'],
            ['nombre_medicamento' => 'Anticonvulsivos', 'descripcion' => 'Controlan las convulsiones y se utilizan para tratar la epilepsia'],
            ['nombre_medicamento' => 'Antihistamínicos', 'descripcion' => 'Tratan alergias y afecciones relacionadas con la histamina'],
            ['nombre_medicamento' => 'Anticoagulantes', 'descripcion' => 'Evitan la formación de coágulos sanguíneos'],
            ['nombre_medicamento' => 'Antihipertensivos', 'descripcion' => 'Controlan la presión arterial alta'],
            ['nombre_medicamento' => 'Antidiabéticos', 'descripcion' => 'Controlan el azúcar en sangre en pacientes con diabetes'],
            ['nombre_medicamento' => 'Antialérgicos', 'descripcion' => 'Alivian síntomas de alergias'],
            ['nombre_medicamento' => 'Antiácidos', 'descripcion' => 'Alivian el malestar estomacal y la acidez'],
            ['nombre_medicamento' => 'Antieméticos', 'descripcion' => 'Reducen las náuseas y los vómitos'],
            ['nombre_medicamento' => 'Broncodilatadores', 'descripcion' => 'Dilatan las vías respiratorias en enfermedades respiratorias'],
            ['nombre_medicamento' => 'Antifúngicos', 'descripcion' => 'Tratan infecciones fúngicas'],
            ['nombre_medicamento' => 'Antiparasitarios', 'descripcion' => 'Tratan infecciones parasitarias'],
            ['nombre_medicamento' => 'Corticosteroides', 'descripcion' => 'Reducen la inflamación y suprimen el sistema inmunológico'],
            ['nombre_medicamento' => 'Anestésicos locales', 'descripcion' => 'Insensibilizan una zona específica del cuerpo'],
            ['nombre_medicamento' => 'Suplementos vitamínicos y minerales', 'descripcion' => 'Suministran nutrientes que el cuerpo necesita'],
        ];

        foreach ($tiposMedicamentos as $tipo) {
            DB::table('tipo_medicamentos')->insert($tipo);
            
        }
    }
}
