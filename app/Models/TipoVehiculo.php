<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoVehiculo extends Model
{
    /** @use HasFactory<\Database\Factories\TipoVehiculoFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tipos_vehiculo';
    protected $fillable = ['nombre'];
}
