<?php

namespace Database\Seeders;

use App\Models\TipoUsuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoUsuario::create(['nombre' => 'Administrador']);
        TipoUsuario::create(['nombre' => 'Cliente']);
        TipoUsuario::create(['nombre' => 'Trabajador']);
    }
}
