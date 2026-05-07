<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que representa un pedido realizado por un usuario.
 * Un pedido puede ser de tipo 'recogida' o 'domicilio' y puede tener
 * estado 'pendiente' o 'realizado'.
 */
class Pedido extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'direccion',      // Dirección de entrega (solo pedidos a domicilio)
        'codigo_postal',  // Código postal de entrega
        'poblacion',      // Población de entrega
        'provincia',      // Provincia de entrega
        'importe',        // Total del pedido en euros
        'estado',         // 'pendiente' o 'realizado'
        'fecha_entrega',  // Fecha y hora estimada de entrega
        'forma',          // Tipo: 'recogida' o 'domicilio'
        'pago_id',        // Clave foránea al método de pago usado
        'usuario_id',     // Clave foránea al usuario que realizó el pedido
    ];

    // Conversiones automáticas de tipos
    protected $casts = [
        'importe' => 'decimal:2',       // Formateado con 2 decimales
        'fecha_entrega' => 'datetime',  // Convertido a objeto Carbon
    ];

    // ==================== RELACIONES ====================

    /**
     * El método de pago utilizado en este pedido (Efectivo o Tarjeta).
     */
    public function pago()
    {
        return $this->belongsTo(Pago::class);
    }

    /**
     * El usuario que realizó el pedido.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    /**
     * Los platos incluidos en el pedido (relación muchos a muchos).
     * La tabla pivot 'pedido_plato' incluye la cantidad de cada plato.
     */
    public function platos()
    {
        return $this->belongsToMany(Plato::class, 'pedido_plato', 'pedido_id', 'plato_id')->withPivot('cantidad');
    }
}
