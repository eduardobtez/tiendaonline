<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categoria';
    protected $primaryKey = 'id';

    public $timestamps = false; // Desactiva created_at y updated_at

    protected $fillable = ['nombre'];

    public function productos()
    {
        // lave foránea correcta en la tabla producto
        return $this->hasMany(Producto::class, 'categoria_id', 'id');
    }
}
