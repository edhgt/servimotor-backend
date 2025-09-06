<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Categoria;
use App\Models\Cliente;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

use App\Models\Color;
use App\Models\Inventario;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Producto;
use App\Models\Sucursal;
use App\Models\TipoCombustible;
use App\Models\TipoMotor;
use App\Models\TipoTransmision;
use App\Models\TipoUsuario;
use App\Models\TipoVehiculo;
use App\Models\UnidadMedida;
use App\Models\User;
use App\Models\Vehiculo;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            CategoriaSeeder::class,
            ColorSeeder::class,
            ClienteSeeder::class,
            EstadoSeeder::class,
            InventarioSeeder::class,
            MarcaSeeder::class,
            ModeloSeeder::class,
            ProductoSeeder::class,
            PuestoSeeder::class,
            ServicioSeeder::class,
            SucursalSeeder::class,
            TipoDocumentoSeeder::class,
            TipoMotorSeeder::class,
            TipoTransmisionSeeder::class,
            TipoUsuarioSeeder::class,
            TipoVehiculoSeeder::class,
            FormaPagoSeeder::class,
            UnidadMedidaSeeder::class,
            VehiculoSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
        ]);

        if (app()->environment('local', 'development')) {
            $user = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'tipo_usuario_id' => TipoUsuario::first()->id,
                'sucursal_id' => Sucursal::factory()->create()->id
            ]);

            $role = Role::find(1);
            $user->assignRole($role);

            Categoria::factory()->count(5)->create();
            Color::factory()->count(10)->create();
            Cliente::factory()->count(1)->create();
            UnidadMedida::factory()->count(5)->create();
            Producto::factory()->count(500)->create();
            Inventario::factory()->count(100)->create();
            Marca::factory()->count(10)->create();
            Modelo::factory()->count(10)->create();
            Sucursal::factory()->count(10)->create();
            TipoMotor::factory()->count(4)->create();
            TipoTransmision::factory()->count(2)->create();
            TipoVehiculo::factory()->count(1)->create();
            Vehiculo::factory()->count(1)->create();
        }
    }
}
