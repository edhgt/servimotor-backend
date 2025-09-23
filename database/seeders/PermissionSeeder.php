<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'home', 'guard_name' => 'web']);
        Permission::create(['name' => 'reservar', 'guard_name' => 'web']);
        Permission::create(['name' => 'busqueda', 'guard_name' => 'web']);
        Permission::create(['name' => 'mis-documentos', 'guard_name' => 'web']);
        Permission::create(['name' => 'pendientes', 'guard_name' => 'web']);
        Permission::create(['name' => 'configuracion', 'guard_name' => 'web']);
        Permission::create(['name' => 'correlativos', 'guard_name' => 'web']);
        Permission::create(['name' => 'correlativos.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'correlativos.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'correlativos.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'correlativos.destroy', 'guard_name' => 'web']);
        Permission::create(['name' => 'plantillas', 'guard_name' => 'web']);
        Permission::create(['name' => 'plantillas.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'plantillas.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'plantillas.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'plantillas.destroy', 'guard_name' => 'web']);
        Permission::create(['name' => 'saludos', 'guard_name' => 'web']);
        Permission::create(['name' => 'saludos.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'saludos.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'saludos.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'saludos.destroy', 'guard_name' => 'web']);
        Permission::create(['name' => 'dependencias', 'guard_name' => 'web']);
        Permission::create(['name' => 'dependencias.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'dependencias.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'dependencias.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'dependencias.destroy', 'guard_name' => 'web']);
        Permission::create(['name' => 'entidades', 'guard_name' => 'web']);
        Permission::create(['name' => 'entidades.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'entidades.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'entidades.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'entidades.destroy', 'guard_name' => 'web']);
        Permission::create(['name' => 'cargos', 'guard_name' => 'web']);
        Permission::create(['name' => 'cargos.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'cargos.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'cargos.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'cargos.destroy', 'guard_name' => 'web']);
        Permission::create(['name' => 'destinatarios', 'guard_name' => 'web']);
        Permission::create(['name' => 'destinatarios.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'destinatarios.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'destinatarios.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'destinatarios.destroy', 'guard_name' => 'web']);
        Permission::create(['name' => 'administrador', 'guard_name' => 'web']);
        Permission::create(['name' => 'bitacora', 'guard_name' => 'web']);
        Permission::create(['name' => 'documentos', 'guard_name' => 'web']);
        Permission::create(['name' => 'documentos.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'documentos.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'documentos.generate-pdf', 'guard_name' => 'web']);
        Permission::create(['name' => 'documentos.download', 'guard_name' => 'web']);
        Permission::create(['name' => 'documentos.upload', 'guard_name' => 'web']);
        Permission::create(['name' => 'documentos.archive', 'guard_name' => 'web']);
        Permission::create(['name' => 'documentos.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'documentos.destroy', 'guard_name' => 'web']);
        Permission::create(['name' => 'reportes', 'guard_name' => 'web']);
        Permission::create(['name' => 'permissions', 'guard_name' => 'web']);
        Permission::create(['name' => 'permissions.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'permissions.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'permissions.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'permissions.destroy', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.destroy', 'guard_name' => 'web']);
        Permission::create(['name' => 'users', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.import', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.destroy', 'guard_name' => 'web']);

        Permission::create(['name' => 'catalogos', 'guard_name' => 'web']);
        Permission::create(['name' => 'categorias', 'guard_name' => 'web']);
        Permission::create(['name' => 'categorias.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'categorias.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'categorias.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'categorias.destroy', 'guard_name' => 'web']);
    }
}
