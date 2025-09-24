<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class IngresoDetalle extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cantidad',
        'precio_unitario',
        'subtotal',
        'ingreso_id',
        'producto_id',
        'deleted_at',
    ];

    public function ingreso(): BelongsTo
    {
        return $this->belongsTo(Ingreso::class);
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}
