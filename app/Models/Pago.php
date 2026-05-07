<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que representa un método de pago disponible (ej. Tarjeta, Efectivo).
 * Cada pedido registra el método de pago utilizado.
 */
class Pago extends Model
{
    use HasFactory;

    // Campos asignables masivamente
    protected $fillable = [
        'nombre',  // Nombre del método de pago
    ];

    // ==================== RELACIONES ====================

    /**
     * Un método de pago puede haberse usado en muchos pedidos.
     */
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
