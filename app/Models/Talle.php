<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Talle extends Model
{
    protected $table = 'talle'; // minúscula
    public $timestamps = false;

    protected $fillable = [
        'nombre',
    ];
}
