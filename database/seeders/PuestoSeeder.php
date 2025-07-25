<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Puesto;

class PuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Puesto::create(['nombre' => 'Jefe de Mecánicos']);
        Puesto::create(['nombre' => 'Mecánicos']);
        Puesto::create(['nombre' => 'Operario de Carwash']);
        Puesto::create(['nombre' => 'Servicio al Cliente']);
        Puesto::create(['nombre' => 'Supervisor de Carwash']);
        Puesto::create(['nombre' => 'Técnico de Repuestos']);
    }
}
