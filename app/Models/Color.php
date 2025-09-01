<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'color'; // minúscula
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'codigo_hex',
        'imagen_url',
    ];
}
