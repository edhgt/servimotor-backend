<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Puesto extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['nombre', 'deleted_at'];
}
