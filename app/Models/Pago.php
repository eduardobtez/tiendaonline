<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pago'; // tabla en minúscula

    public $timestamps = true; // created_at existe

    protected $fillable = [
        'pedido_id',
        'metodo',
        'estado',
        'monto',
    ];

    // Relación con Pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id');
    }

    // Opciones válidas (helpers)
    public static function metodosValidos(): array
    {
        return ['efectivo', 'tarjeta', 'transferencia', 'mercadopago', 'otro'];
    }

    public static function estadosValidos(): array
    {
        return ['pendiente', 'pagado', 'fallido'];
    }
}
