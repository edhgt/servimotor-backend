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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->double('total');
            $table->foreignId('cliente_id')->constrained();
            $table->foreignId('empleado_id')->constrained()->comment('Empleado que generó la factura');
            $table->foreignId('sucursal_id')->constrained('sucursales');
            $table->foreignId('forma_pago_id')->constrained('formas_pago');
            $table->foreignId('estado_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
