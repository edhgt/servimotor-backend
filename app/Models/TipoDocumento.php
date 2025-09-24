<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoDocumento extends Model
{
    /** @use HasFactory<\Database\Factories\TipoDocumentoFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tipos_documento';
    protected $fillable = ['nombre', 'deleted_at'];
}
