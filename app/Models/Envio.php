<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pedido;

class Envio extends Model
{
    protected $table = 'envio';

    protected $fillable = [
        'pedido_id',
        'estado_envio',
        'empresa_envio',
        'numero_seguimiento',
        'fecha_envio',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }
}
