<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(GeneroSeeder::class);
        $this->call(NacionalidadSeeder::class);
        $this->call(TipoRelacionSeeder::class);
        $this->call(PersonaSeeder::class);
        $this->call(ContactoSeeder::class);
        $this->call(RegistroDiarioAtencionSeeder::class);
        $this->call(TipoMedicamentoSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(MedicamentoSeeder::class);
        $this->call(TipoSuministroSeeder::class);
        $this->call(SuministroSeeder::class);
        $this->call(EmpleadoSeeder::class);
        $this->call(PreferenciaSeeder::class);
        $this->call(SeguimientoSeeder::class);
        $this->call(IncidenteSeeder::class);
        $this->call(ResultadoPruebaMedicaSeeder::class);
        $this->call(AntecedentesMedicosSeeder::class);
        $this->call(HistorialMedicamentosSeeder::class);
        $this->call(AdoptanteSeeder::class);
        $this->call(AdopcionSeeder::class);
        
        
        

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
