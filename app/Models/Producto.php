<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';

    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria_id',
        'tipo_id',
        'precio',
        'costo',
        'activo',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function tipo()
    {
        return $this->belongsTo(TipoProducto::class, 'tipo_id');
    }
}
