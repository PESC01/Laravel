<?php

namespace Database\Seeders;

use App\Models\TipoRelacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoRelacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo = new TipoRelacion();
        $tipo->nombre = "Hijo/a";
        $tipo->save();

        $tipo = new TipoRelacion();
        $tipo->nombre = "Hermano/a";
        $tipo->save();

        $tipo = new TipoRelacion();
        $tipo->nombre = "Amigo/a";
        $tipo->save();

        $tipo = new TipoRelacion();
        $tipo->nombre = "Conyugue";
        $tipo->save();

        $tipo = new TipoRelacion();
        $tipo->nombre = "Nieto/a";
        $tipo->save();

        $tipo = new TipoRelacion();
        $tipo->nombre = "Otro";
        $tipo->save();
    }
}
