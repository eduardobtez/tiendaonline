<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variante extends Model
{
    protected $table = 'variante';

    protected $fillable = [
        'producto_id',
        'color_id',
        'talle_id',
        'codigo_barra',
        'stock',
        'peso',
        'imagen_url',
    ];

    // Relaciones
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function talle()
    {
        return $this->belongsTo(Talle::class, 'talle_id');
    }

    public function imagenes()
    {
        return $this->hasMany(VarianteImagen::class, 'variante_id');
    }
}
