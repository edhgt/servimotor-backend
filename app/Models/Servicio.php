<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicio extends Model
{
    /** @use HasFactory<\Database\Factories\MarcaFactory> */
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio_estandar',
    ];
}
