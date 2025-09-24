<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CotizacionDetalle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cantidad',
        'precio_unitario',
        'subtotal',
        'cotizacion_id',
        'producto_id',
        'deleted_at'
    ];

    public function cotizacion(): BelongsTo
    {
        return $this->belongsTo(Cotizacion::class);
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}
