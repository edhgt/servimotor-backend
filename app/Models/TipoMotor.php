<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoMotor extends Model
{
    /** @use HasFactory<\Database\Factories\TipoMotorFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tipos_motor';
    protected $fillable = ['nombre'];
}
