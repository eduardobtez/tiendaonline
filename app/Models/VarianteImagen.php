<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VarianteImagen extends Model
{
    protected $table = 'variante_imagen';
    protected $primaryKey = 'id';
    protected $fillable = ['variante_id', 'imagen_url'];

    public function variante()
    {
        return $this->belongsTo(Variante::class);
    }
}
