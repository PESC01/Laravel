<?php

namespace Database\Seeders;

use App\Models\Nacionalidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NacionalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nacionalidad = new Nacionalidad();
        $nacionalidad->nombre_nacionalidad = "Bolivia";
        $nacionalidad->save();

        $nacionalidad = new Nacionalidad();
        $nacionalidad->nombre_nacionalidad = "Argentina";
        $nacionalidad->save();
        
        $nacionalidad = new Nacionalidad();
        $nacionalidad->nombre_nacionalidad = "Colombia";
        $nacionalidad->save();

        $nacionalidad = new Nacionalidad();
        $nacionalidad->nombre_nacionalidad = "Chile";
        $nacionalidad->save();

        $nacionalidad = new Nacionalidad();
        $nacionalidad->nombre_nacionalidad = "Uruguay";
        $nacionalidad->save();

        $nacionalidad = new Nacionalidad();
        $nacionalidad->nombre_nacionalidad = "Paraguay";
        $nacionalidad->save();

        $nacionalidad = new Nacionalidad();
        $nacionalidad->nombre_nacionalidad = "Brasil";
        $nacionalidad->save();

        $nacionalidad = new Nacionalidad();
        $nacionalidad->nombre_nacionalidad = "Perú";
        $nacionalidad->save();

        $nacionalidad = new Nacionalidad();
        $nacionalidad->nombre_nacionalidad = "Ecuador";
        $nacionalidad->save();

        $nacionalidad = new Nacionalidad();
        $nacionalidad->nombre_nacionalidad = "Venezuela";
        $nacionalidad->save();
    }
}
