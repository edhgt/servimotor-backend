<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Empleado extends Model
{
    /** @use HasFactory<\Database\Factories\ColorFactory> */
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'nit',
        'cui',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'fecha_nacimiento',
        'direccion',
        'telefono',
        'fecha_contratacion',
        'puesto_id',
        'sucursal_id',
        'user_id',
        'deleted_at',
    ];

    public function getNombreCompletoAttribute()
    {
        return preg_replace('/\s+/', ' ', trim("{$this->primer_nombre} {$this->segundo_nombre} {$this->primer_apellido} {$this->segundo_apellido}"));
    }

    public function puesto(): BelongsTo
    {
        return $this->belongsTo(Puesto::class);
    }

    public function sucursal(): BelongsTo
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
