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
        Schema::create('ordenes_servicio', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha_ingreso');
            $table->timestamp('fecha_estimada_entrega');
            $table->timestamp('fecha_entrega');
            $table->string('notas')->nullable();
            $table->foreignId('estado_id')->constrained();
            $table->foreignId('vehiculo_id')->constrained();
            $table->foreignId('cliente_id')->constrained();
            $table->foreignId('ingreado_por')->constrained('empleados');
            $table->foreignId('recibido_por')->constrained('empleados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes_servicio');
    }
};
