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
        Schema::create('ordenes_trabajo', function (Blueprint $table) {
            $table->id();
            $table->string('observaciones')->nullable();
            $table->double('precio_final');
            $table->foreignId('order_servicio_id')->constrained('ordenes_servicio');
            $table->foreignId('servicio_id')->constrained();
            $table->foreignId('empleado_id')->constrained()->comment('técnico asignado');
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
        Schema::dropIfExists('ordenes_trabajo');
    }
};
