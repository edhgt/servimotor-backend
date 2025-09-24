<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventario extends Model
{
    /** @use HasFactory<\Database\Factories\InventarioFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'existencia',
        'existencia_minima',
        'existencia_maxima',
        'producto_id',
        'sucursal_id',
        'deleted_at',
    ];

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }

    public function sucursal(): BelongsTo
    {
        return $this->belongsTo(Sucursal::class);
    }
}
