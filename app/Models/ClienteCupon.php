<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modelo pivote de la relación many-to-many entre clientes y cupones canjeados.
 * Registra qué clientes han adquirido qué cupones con sus puntos de fidelidad.
 */
class ClienteCupon extends Pivot
{
    use HasFactory;

    // Nombre explícito de la tabla pivote
    protected $table = 'cliente_cupon';

    // Se guardan timestamps para saber cuándo se canjeó el cupón
    public $timestamps = true; 

    // Campos asignables masivamente
    protected $fillable = ['cliente_id', 'cupon_id'];
    
    // Clave primaria compuesta, no autoincremental
    public $incrementing = false;
}
