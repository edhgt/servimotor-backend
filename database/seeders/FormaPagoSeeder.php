<?php

namespace Database\Seeders;

use App\Models\FormaPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormaPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FormaPago::create(['nombre' => 'Cheque Propio']);
        FormaPago::create(['nombre' => 'Cheque Otros Bancos']);
        FormaPago::create(['nombre' => 'Efectivo']);
        FormaPago::create(['nombre' => 'Tarjeta']);
        FormaPago::create(['nombre' => 'Transferencia Banco Propio']);
        FormaPago::create(['nombre' => 'Transferencia Otros Bancos']);
    }
}
