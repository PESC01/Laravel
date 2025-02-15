<?php

namespace Database\Seeders;

use App\Models\Persona;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $persona = new Persona();
        $persona->nombres = "Augusto";
        $persona->apellidos = "Sanchez Cavina";
        $persona->fech_nac = "1970-02-10";
        $persona->ci = "43893824";
        $persona->estado_civil ="casado";
        $persona->nacionalidad = "1";
        $persona->genero = "1";
        $persona->motivo_ingreso = "Dolores en todo el cuerpo";
        $persona->firma_consentimiento = "firma.jpg";
        $persona->fech_registro ="2023-12-12";
        $persona->hora_registro = "16:13:33";
        $persona->save();
    }
}
