<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que representa un alérgeno (ej. Gluten, Lácteos, Frutos secos).
 * Se asocia a platos mediante una tabla pivote alergeno_plato.
 */
class Alergeno extends Model
{
    use HasFactory;

    // Campos asignables masivamente
    protected $fillable = [
        'nombre',  // Nombre del alérgeno (ej. "Gluten")
        'imagen',  // Icono o imagen representativa del alérgeno
    ];

    // ==================== RELACIONES ====================

    /**
     * Un alérgeno puede estar presente en muchos platos.
     * Relación many-to-many a través de la tabla alergeno_plato.
     */
    public function platos()
    {
        return $this->belongsToMany(Plato::class, 'alergeno_plato', 'alergeno_id', 'plato_id');
    }
}
