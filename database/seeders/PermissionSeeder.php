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

        Permission::create(['name' => 'administrador', 'guard_name' => 'web']);
        
        Permission::create(['name' => 'users', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.destroy', 'guard_name' => 'web']);

        Permission::create(['name' => 'roles', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.destroy', 'guard_name' => 'web']);

        Permission::create(['name' => 'permissions', 'guard_name' => 'web']);
        Permission::create(['name' => 'permissions.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'permissions.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'permissions.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'permissions.destroy', 'guard_name' => 'web']);

        Permission::create(['name' => 'catalogos', 'guard_name' => 'web']);
        Permission::create(['name' => 'categorias', 'guard_name' => 'web']);
        Permission::create(['name' => 'categorias.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'categorias.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'categorias.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'categorias.destroy', 'guard_name' => 'web']);

        Permission::create(['name' => 'colores', 'guard_name' => 'web']);
        Permission::create(['name' => 'colores.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'colores.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'colores.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'colores.destroy', 'guard_name' => 'web']);

        Permission::create(['name' => 'marcas', 'guard_name' => 'web']);
        Permission::create(['name' => 'marcas.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'marcas.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'marcas.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'marcas.destroy', 'guard_name' => 'web']);

        Permission::create(['name' => 'modelos', 'guard_name' => 'web']);
        Permission::create(['name' => 'modelos.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'modelos.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'modelos.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'modelos.destroy', 'guard_name' => 'web']);

        Permission::create(['name' => 'estados', 'guard_name' => 'web']);
        Permission::create(['name' => 'estados.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'estados.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'estados.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'estados.destroy', 'guard_name' => 'web']);

        Permission::create(['name' => 'puestos', 'guard_name' => 'web']);
        Permission::create(['name' => 'puestos.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'puestos.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'puestos.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'puestos.destroy', 'guard_name' => 'web']);

        Permission::create(['name' => 'tipos-vehiculo', 'guard_name' => 'web']);
        Permission::create(['name' => 'tipos-vehiculo.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'tipos-vehiculo.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'tipos-vehiculo.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'tipos-vehiculo.destroy', 'guard_name' => 'web']);

        Permission::create(['name' => 'tipos-motor', 'guard_name' => 'web']);
        Permission::create(['name' => 'tipos-motor.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'tipos-motor.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'tipos-motor.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'tipos-motor.destroy', 'guard_name' => 'web']);

        Permission::create(['name' => 'tipos-transmision', 'guard_name' => 'web']);
        Permission::create(['name' => 'tipos-transmision.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'tipos-transmision.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'tipos-transmision.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'tipos-transmision.destroy', 'guard_name' => 'web']);

        Permission::create(['name' => 'unidades-medida', 'guard_name' => 'web']);
        Permission::create(['name' => 'unidades-medida.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'unidades-medida.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'unidades-medida.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'unidades-medida.destroy', 'guard_name' => 'web']);

        Permission::create(['name' => 'formas-pago', 'guard_name' => 'web']);
        Permission::create(['name' => 'formas-pago.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'formas-pago.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'formas-pago.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'formas-pago.destroy', 'guard_name' => 'web']);

        Permission::create(['name' => 'tipos-documento', 'guard_name' => 'web']);
        Permission::create(['name' => 'tipos-documento.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'tipos-documento.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'tipos-documento.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'tipos-documento.destroy', 'guard_name' => 'web']);

        Permission::create(['name' => 'servicios', 'guard_name' => 'web']);
        Permission::create(['name' => 'servicios.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'servicios.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'servicios.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'servicios.destroy', 'guard_name' => 'web']);

        Permission::create(['name' => 'clientes', 'guard_name' => 'web']);
        Permission::create(['name' => 'clientes.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'clientes.agregar-vehiculo', 'guard_name' => 'web']);
        Permission::create(['name' => 'clientes.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'clientes.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'clientes.destroy', 'guard_name' => 'web']);

        Permission::create(['name' => 'vehiculos', 'guard_name' => 'web']);
        Permission::create(['name' => 'vehiculos.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'vehiculos.agregar-vehiculo', 'guard_name' => 'web']);
        Permission::create(['name' => 'vehiculos.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'vehiculos.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'vehiculos.destroy', 'guard_name' => 'web']);
    }
}
