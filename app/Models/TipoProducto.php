<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    protected $table = 'tipoproducto';
    public $timestamps = false;

    protected $fillable = ['nombre', 'descripcion'];
}
