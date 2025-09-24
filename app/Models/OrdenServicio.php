<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrdenServicio extends Model
{
    protected $table = 'ordenes_servicio';
    protected $fillable = [
            'fecha_ingreso',
            'fecha_estimada_entrega',
            'fecha_entrega',
            'notas',
            'estado_id',
            'vehiculo_id',
            'cliente_id',
            'ingreado_por',
            'recibido_por',
            'deleted_at'
    ];

    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class);
    }

    public function vehiculo(): BelongsTo
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function ingresadoPor(): BelongsTo
    {
        return $this->belongsTo(Empleado::class, 'ingresado_por');
    }

    public function recibidoPor(): BelongsTo
    {
        return $this->belongsTo(Empleado::class, 'recibido_por');
    }
}
