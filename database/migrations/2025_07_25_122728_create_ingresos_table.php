<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_documento');
            $table->string('numero_documento');
            $table->double('total');
            $table->foreignId('tipo_documento_id')->constrained('tipos_documento');
            $table->foreignId('proveedor_id')->constrained('proveedores');
            $table->foreignId('empleado_id')->constrained()->comment('Empleado que realizó el ingreso');
            $table->foreignId('sucursal_id')->constrained('sucursales');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresos');
    }
};
