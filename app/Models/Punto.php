<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que representa un movimiento de puntos de fidelidad de un cliente.
 * Cada fila es una transacción: suma (compra) o resta (canje de cupón).
 */
class Punto extends Model
{
    use HasFactory;

    // Nombre explícito de la tabla
    protected $table = 'puntos';

    // Campos asignables masivamente
    protected $fillable = [
        'cliente_id',      // Cliente al que pertenece el movimiento
        'cupon_id',        // Cupón canjeado (null si es un abono por compra)
        'cantidad_puntos', // Puntos ganados (positivo) o gastados (negativo)
        'concepto',        // Descripción del movimiento (ej. "Compra pedido #42")
    ];

    // ==================== RELACIONES ====================

    /**
     * El movimiento de puntos pertenece a un cliente.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'usuario_id');
    }

    /**
     * El movimiento de puntos puede estar asociado a un cupón (al canjear).
     */
    public function cupon()
    {
        return $this->belongsTo(Cupon::class);
    }
}
