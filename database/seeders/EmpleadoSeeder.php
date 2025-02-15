<?php

namespace Database\Seeders;

use App\Models\Empleado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $personal = new  Empleado();
        $personal->nombres = "Nicol";
        $personal->apellidos = "Sanchez";
        $personal->celular = "73829323";
        $personal->calificaciones = "Doctora especialista en ";
        $personal->certificaciones = "Lista de certificaciones";
        $personal->antecedentes = "Ninguno";
        $personal->save();

        $personal = new  Empleado();
        $personal->nombres = "Yahir";
        $personal->apellidos = "Fernández";
        $personal->celular = "77228833";
        $personal->calificaciones = "Ninguna ";
        $personal->certificaciones = "Lista de certificaciones";
        $personal->antecedentes = "Ninguno";
        $personal->save();
        
        
    }
}
