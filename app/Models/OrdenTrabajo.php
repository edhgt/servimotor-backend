<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrdenTrabajo extends Model
{
    protected $table = 'ordenes_trabajo';
    protected $fillable = [
            'observaciones',
            'precio_final',
            'order_servicio_id',
            'servicio_id',
            'empleado_id',
            'estado_id',
            'deleted_at'
    ];

    public function ordenServicio(): BelongsTo
    {
        return $this->belongsTo(OrdenServicio::class);
    }

    public function servicio(): BelongsTo
    {
        return $this->belongsTo(Servicio::class);
    }

    public function empleado(): BelongsTo
    {
        return $this->belongsTo(Empleado::class);
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class);
    }
}
