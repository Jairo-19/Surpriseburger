<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que representa una reseña de un cliente sobre el restaurante.
 * Contiene el texto de la reseña, la valoración en estrellas (1-5) y la fecha.
 */
class Resena extends Model
{
    use HasFactory;

    // Nombre explícito de la tabla (sin tilde en la base de datos)
    protected $table = 'resenas';

    // Campos asignables masivamente
    protected $fillable = [
        'cliente_id',  // Cliente autor de la reseña
        'fecha',       // Fecha en que se publicó la reseña
        'texto',       // Texto de la reseña escrito por el cliente
        'valoracion',  // Puntuación del 1 al 5 en estrellas
    ];

    // Conversiones automáticas de tipos
    protected $casts = [
        'fecha'      => 'date',    // Se trata como objeto Carbon de fecha
        'valoracion' => 'integer', // Se garantiza que sea entero
    ];

    // ==================== RELACIONES ====================

    /**
     * La reseña pertenece a un cliente.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'usuario_id');
    }
}
