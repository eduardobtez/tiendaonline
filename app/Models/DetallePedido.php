<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Variante;

class DetallePedido extends Model
{
    protected $table = 'detallepedido';

    protected $fillable = [
        'pedido_id',
        'variante_id',
        'cantidad',
        'precio_unitario'
    ];

    public function variante()
    {
        return $this->belongsTo(Variante::class, 'variante_id');
    }
}
