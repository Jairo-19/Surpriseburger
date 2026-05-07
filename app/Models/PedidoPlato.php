<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modelo pivote de la relación many-to-many entre pedidos y platos.
 * Almacena la cantidad de cada plato incluida en un pedido.
 */
class PedidoPlato extends Pivot
{
    use HasFactory;

    // Nombre explícito de la tabla pivote
    protected $table = 'pedido_plato';

    // La tabla pivote no usa timestamps
    public $timestamps = false;

    // Campos asignables masivamente
    protected $fillable = [
        'pedido_id',  // Pedido al que pertenece
        'plato_id',   // Plato incluido en el pedido
        'cantidad',   // Número de unidades del plato en el pedido
    ];
}
