<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

use App\Models\Color;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Sucursal;
use App\Models\TipoCombustible;
use App\Models\TipoMotor;
use App\Models\TipoTransmision;
use App\Models\TipoUsuario;
use App\Models\TipoVehiculo;
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
            ColorSeeder::class,
            ClienteSeeder::class,
            MarcaSeeder::class,
            ModeloSeeder::class,
            PuestoSeeder::class,
            SucursalSeeder::class,
            TipoMotorSeeder::class,
            TipoTransmisionSeeder::class,
            TipoUsuarioSeeder::class,
            TipoVehiculoSeeder::class,
            VehiculoSeeder::class,
        ]);

        if (app()->environment('local', 'development')) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'tipo_usuario_id' => TipoUsuario::first()->id,
                'sucursal_id' => Sucursal::factory()->create()->id
            ]);

            Color::factory()->count(10)->create();
            Cliente::factory()->count(1)->create();
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
