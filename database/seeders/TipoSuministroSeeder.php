<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSuministroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipoSuministros = [
            ["nombre" => "Médicos", "descripcion" => "Suministros médicos y de enfermería"],
            ["nombre" => "Cuidado Personal", "descripcion" => "Pañales para adultos, productos de higiene personal"],
            ["nombre" => "Cocina y Comedor", "descripcion" => "Utensilios de cocina, vajilla y cubertería"],
            ["nombre" => "Limpieza", "descripcion" => "Productos de limpieza y desinfección"],
            ["nombre" => "Entretenimiento", "descripcion" => "Libros, juegos y actividades recreativas"],
            ["nombre" => "Seguridad", "descripcion" => "Equipos de seguridad y prevención"],
            ["nombre" => "Movilidad", "descripcion" => "Colchones, camas y sillas ajustables"],
            ["nombre" => "Administración", "descripcion" => "Equipo de oficina y registros"],
            ["nombre" => "Protección Personal", "descripcion" => "Equipos de protección personal"],
        ];

        DB::table('tipo_suministros')->insert($tipoSuministros);
    }
}
