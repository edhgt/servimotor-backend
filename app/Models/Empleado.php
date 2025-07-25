<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Empleado extends Model
{
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
        'correo',
        'fecha_contratacion',
        'puesto_id',
        'sucursal_id',
        'user_id',
    ];

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
