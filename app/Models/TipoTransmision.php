<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoTransmision extends Model
{
    /** @use HasFactory<\Database\Factories\TipoTransmisionFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tipos_transmision';
    protected $fillable = ['nombre'];
}
