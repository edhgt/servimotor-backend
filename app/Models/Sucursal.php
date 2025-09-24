<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sucursal extends Model
{
    /** @use HasFactory<\Database\Factories\SucursalFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sucursales';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'correo',
        'region',
        'deleted_at',
    ];
}
