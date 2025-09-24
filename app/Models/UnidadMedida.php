<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnidadMedida extends Model
{
    /** @use HasFactory<\Database\Factories\UnidadMedidaFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'unidades_medida';
    protected $fillable = ['nombre', 'simbolo', 'deleted_at'];
}
