<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que representa a un empleado/administrador del restaurante.
 * Vincula al usuario con el rol de empleado (tabla empleados).
 */
class Empleado extends Model
{
    use HasFactory;

    // Los empleados no necesitan timestamps de creación/actualización
    public $timestamps = false;

    // Campos asignables masivamente
    protected $fillable = [
        'usuario_id',  // Referencia al usuario con rol de empleado/admin
    ];

    // ==================== RELACIONES ====================

    /**
     * El empleado pertenece a un usuario autenticable.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
