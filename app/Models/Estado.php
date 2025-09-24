<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{
    /** @use HasFactory<\Database\Factories\EstadoFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nombre', 'deleted_at'];
}
