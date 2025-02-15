<?php

namespace Database\Seeders;

use App\Models\Contacto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacto = new Contacto();
        $contacto->nombres = "Enrique";
        $contacto->apellidos = "Espinoza Salazar";
        $contacto->direccion_vivienda = "Barrio Nuevo";
        $contacto->celular = "77338899";
        $contacto->tipo_relacion = "1";
        $contacto->persona = "1";
        $contacto->save();
    }
}
