<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proveedor = new Proveedor();
        $proveedor->nombres = "Victor";
        $proveedor->apellidos ="Heredia Alfaro";
        $proveedor->ci ="1234566";
        $proveedor->celular ="42352235";
        $proveedor->save();
    }
}
