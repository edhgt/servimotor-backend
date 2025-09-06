<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Super Admin', 'guard_name'=>'web']);
        $administrador = Role::create(['name' => 'Administrador', 'guard_name'=>'web']);
        $usuarioBasico = Role::create(['name' => 'Usuario Básico', 'guard_name'=>'web']);

        $permisosParaAdministrador = Permission::whereNot('name', 'LIKE', ['permissions%', 'roles%', 'users%', 'administrador'])->get();
        $permisosParaUsuarioBasico = Permission::whereIn('name', [
            'home',
            'reservar',
            'busqueda',
            'mis-documentos',
            'pendientes',
            'documentos.create',
            'documentos.show',
            'documentos.generate-pdf',
            'documentos.download',
            'documentos.upload',
            'documentos.archive',
            'documentos.edit',
            'documentos.destroy',
        ])->get();
        $administrador->permissions()->attach($permisosParaAdministrador);
        $usuarioBasico->permissions()->attach($permisosParaUsuarioBasico);
    }
}
