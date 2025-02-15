<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicamentoSeeder extends Seeder
{
    public function run(): void
    {
        $medicamentos = [
            ["nombre_medicamento" => "Paracetamol", "descripcion" => "Analgésico y antipirético", "cantidad" => 100, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Ibuprofeno", "descripcion" => "Antiinflamatorio y analgésico", "cantidad" => 150, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Lorazepam", "descripcion" => "Ansiolítico", "cantidad" => 75, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Omeprazol", "descripcion" => "Antiácido y antiulceroso", "cantidad" => 200, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Losartán", "descripcion" => "Antihipertensivo", "cantidad" => 120, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Metformina", "descripcion" => "Antidiabético", "cantidad" => 80, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Simvastatina", "descripcion" => "Hipolipemiante", "cantidad" => 90, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Amitriptilina", "descripcion" => "Antidepresivo", "cantidad" => 60, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Atorvastatina", "descripcion" => "Hipolipemiante", "cantidad" => 70, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Aspirina", "descripcion" => "Antiagregante plaquetario", "cantidad" => 100, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Warfarina", "descripcion" => "Anticoagulante", "cantidad" => 110, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Diazepam", "descripcion" => "Ansiolítico", "cantidad" => 50, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Levotiroxina", "descripcion" => "Hormona tiroidea", "cantidad" => 60, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Metoprolol", "descripcion" => "Antihipertensivo", "cantidad" => 80, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Clopidogrel", "descripcion" => "Antiagregante plaquetario", "cantidad" => 90, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Pantoprazol", "descripcion" => "Antiácido y antiulceroso", "cantidad" => 70, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Tramadol", "descripcion" => "Analgésico", "cantidad" => 100, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Risperidona", "descripcion" => "Antipsicótico", "cantidad" => 55, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Fluoxetina", "descripcion" => "Antidepresivo", "cantidad" => 60, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Alprazolam", "descripcion" => "Ansiolítico", "cantidad" => 40, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Pregabalina", "descripcion" => "Antiepiléptico", "cantidad" => 35, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Metilfenidato", "descripcion" => "Estimulante del sistema nervioso central", "cantidad" => 25, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Amlodipina", "descripcion" => "Antihipertensivo", "cantidad" => 85, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Tamsulosina", "descripcion" => "Relajante muscular", "cantidad" => 45, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Doxazosina", "descripcion" => "Antihipertensivo", "cantidad" => 60, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Cetirizina", "descripcion" => "Antihistamínico", "cantidad" => 70, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Ranitidina", "descripcion" => "Antiácido y antiulceroso", "cantidad" => 75, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Lisinopril", "descripcion" => "Antihipertensivo", "cantidad" => 90, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Sertralina", "descripcion" => "Antidepresivo", "cantidad" => 55, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Fenitoína", "descripcion" => "Antiepiléptico", "cantidad" => 40, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Duloxetina", "descripcion" => "Antidepresivo", "cantidad" => 30, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Carbamazepina", "descripcion" => "Antiepiléptico", "cantidad" => 50, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Atenolol", "descripcion" => "Antihipertensivo", "cantidad" => 80, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Prednisona", "descripcion" => "Corticosteroide", "cantidad" => 60, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Ciclobenzaprina", "descripcion" => "Relajante muscular", "cantidad" => 75, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Naproxeno", "descripcion" => "Antiinflamatorio y analgésico", "cantidad" => 65, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Metoclopramida", "descripcion" => "Antiemético", "cantidad" => 55, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Donepezil", "descripcion" => "Tratamiento del Alzheimer", "cantidad" => 25, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Meloxicam", "descripcion" => "Antiinflamatorio y analgésico", "cantidad" => 35, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Piroxicam", "descripcion" => "Antiinflamatorio y analgésico", "cantidad" => 45, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Bupropion", "descripcion" => "Antidepresivo", "cantidad" => 50, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Furosemida", "descripcion" => "Diurético", "cantidad" => 40, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Hidroclorotiazida", "descripcion" => "Diurético", "cantidad" => 60, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Tiotropio", "descripcion" => "Broncodilatador", "cantidad" => 30, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Alendronato", "descripcion" => "Tratamiento de la osteoporosis", "cantidad" => 40, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Esomeprazol", "descripcion" => "Antiácido y antiulceroso", "cantidad" => 55, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Citalopram", "descripcion" => "Antidepresivo", "cantidad" => 45, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Venlafaxina", "descripcion" => "Antidepresivo", "cantidad" => 30, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Glimepirida", "descripcion" => "Antidiabético", "cantidad" => 50, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Diclofenaco", "descripcion" => "Antiinflamatorio y analgésico", "cantidad" => 65, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Benzodiazepinas", "descripcion" => "Ansiolíticos", "cantidad" => 75, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Metronidazol", "descripcion" => "Antibiótico y antiprotozoario", "cantidad" => 60, "tipo" => rand(1, 20), "proveedor" => 1],
            ["nombre_medicamento" => "Ketorolaco", "descripcion" => "Analgésico y antiinflamatorio", "cantidad" => 40, "tipo" => rand(1, 20), "proveedor" => 1],
        ];

        foreach ($medicamentos as $medicamento) {
            DB::table('medicamentos')->insert($medicamento);
        }
    }
}
