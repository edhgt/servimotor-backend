<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estado::create(['nombre' => 'Aceptada']);
        Estado::create(['nombre' => 'Atendida']);
        Estado::create(['nombre' => 'Anulada']);
        Estado::create(['nombre' => 'Cancelada']);
        Estado::create(['nombre' => 'Cancelado']);
        Estado::create(['nombre' => 'Confirmada']);
        Estado::create(['nombre' => 'Entregado']);
        Estado::create(['nombre' => 'Enviada']);
        Estado::create(['nombre' => 'En espera']);
        Estado::create(['nombre' => 'En ingreso']);
        Estado::create(['nombre' => 'En proceso']);
        Estado::create(['nombre' => 'Finalizado']);
        Estado::create(['nombre' => 'Pagada']);
        Estado::create(['nombre' => 'Pendiente']);
        Estado::create(['nombre' => 'Recibido']);
        Estado::create(['nombre' => 'Rechazada']);
        Estado::create(['nombre' => 'Terminado']);
        Estado::create(['nombre' => 'Trabajando']);
    }
}
