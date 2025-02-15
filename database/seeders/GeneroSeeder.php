<?php

namespace Database\Seeders;

use App\Models\Genero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genero = new Genero();
        $genero->nombre_genero = "Masculino";
        $genero->save();
        
        $genero = new Genero();
        $genero->nombre_genero = "Femenino";
        $genero->save();
    }
}
