<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factura extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cliente_id',
        'empleado_id',
        'sucursal_id',
        'forma_pago_id',
        'estado_id',
        'deleted_at',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function empleado(): BelongsTo
    {
        return $this->belongsTo(Empleado::class);
    }

    public function sucursal(): BelongsTo
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function formaPago(): BelongsTo
    {
        return $this->belongsTo(FormaPago::class);
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class);
    }
}
