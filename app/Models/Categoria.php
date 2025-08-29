<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'categoria';

    // Clave primaria personalizada
    protected $primaryKey = 'id_categoria';

    // Desactivar timestamps
    public $timestamps = false;

    // Campos asignables
    protected $fillable = ['nombre'];
}
