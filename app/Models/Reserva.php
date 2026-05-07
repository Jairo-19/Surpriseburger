<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que representa una reserva de mesa en el restaurante.
 * Almacena la fecha, hora, número de comensales y el estado de la reserva.
 */
class Reserva extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'usuario_id',       // Usuario que realizó la reserva
        'fecha',            // Fecha de la reserva
        'hora',             // Hora de la reserva
        'numero_personas',  // Número de comensales
        'notas',            // Observaciones especiales (alergias, preferencias, etc.)
        'estado',           // Estado: 'pendiente', 'confirmada', 'cancelada'
    ];

    // Conversiones automáticas de tipos de datos
    protected $casts = [
        'fecha' => 'date',           // Se trata como objeto Carbon de fecha
        'hora' => 'datetime:H:i',   // Se trata como objeto Carbon de hora
    ];

    // ==================== RELACIONES ====================

    /**
     * La reserva pertenece a un usuario registrado.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
