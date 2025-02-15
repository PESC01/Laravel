<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'personal-list',
            'personal-create',
            'personal-edit',
            'personal-delete',

            'adopcion-list',
            'adopcion-create',
            'adopcion-edit',
            'adopcion-delete',

            'adoptante-list',
            'adoptante-create',
            'adoptante-edit',
            'adoptante-delete',

            'medicamento-list',
            'medicamento-create',
            'medicamento-edit',
            'medicamento-delete',

            'proveedor-list',
            'proveedor-create',
            'proveedor-edit',
            'proveedor-delete',

            'suministro-list',
            'suministro-create',
            'suministro-edit',
            'suministro-delete',

            'tmedicamento-list',
            'tmedicamento-create',
            'tmedicamento-edit',
            'tmedicamento-delete',

            'tsuministro-list',
            'tsuministro-create',
            'tsuministro-edit',
            'tsuministro-delete',

            'persona-list',
            'persona-create',
            'persona-edit',
            'persona-delete',

            'documentoslegales-list',
            'documentoslegales-create',
            'documentoslegales-edit',
            'documentoslegales-delete',


            'home-access'
        ];

        foreach ($permissions as $permission) {
            // Verificar si el permiso ya existe antes de crearlo
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }
    }
}
