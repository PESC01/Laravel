<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Adoptante;

class AdoptanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adoptante = new Adoptante;
        $adoptante->nombres = "Miguel ";
        $adoptante->apellidos = "Suarez";
        $adoptante->celular = "12538243";
        $adoptante->domicilio = "Calle ABC";
        $adoptante->save();
    }
}
