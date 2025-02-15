<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verifica si el usuario ya existe
        $user = User::where('email', 'esther@gmail.com')->first();

        if (!$user) {
            $user = User::create([
                'name' => 'Esther',
                'email' => 'esther@gmail.com',
                'password' => bcrypt('Es-12345')
            ]);
        }

        // Verifica si el rol ya existe antes de crearlo
        $role = Role::firstOrCreate(['name' => 'Administrador']);

        // Obtener todos los permisos
        $permissions = Permission::pluck('name')->all();

        // Asignar permisos al rol
        $role->syncPermissions($permissions);

        // Asignar el rol al usuario si no lo tiene
        if (!$user->hasRole($role->name)) {
            $user->assignRole($role);
        }
    }
}
