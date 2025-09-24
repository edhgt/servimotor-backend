<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacturaDetalles extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cantidad',
        'precio_unitario',
        'descuento',
        'subtotal',
        'factura_id',
        'producto_id',
        'deleted_at',
    ];

    public function factura(): BelongsTo
    {
        return $this->belongsTo(Factura::class);
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}
