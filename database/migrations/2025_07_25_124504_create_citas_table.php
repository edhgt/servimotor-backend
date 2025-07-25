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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha');
            $table->string('motivo');
            $table->foreignId('cliente_id')->constrained();
            $table->foreignId('vehiculo_id')->constrained();
            $table->foreignId('empleado_id')->nullable()->constrained()->comment('Empleado que generó la cita');
            $table->foreignId('sucursal_id')->nullable()->constrained('sucursales');
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
        Schema::dropIfExists('citas');
    }
};
