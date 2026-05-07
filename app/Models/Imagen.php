<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que representa una imagen asociada a un plato del menú.
 * Cada plato puede tener múltiples imágenes almacenadas en el storage.
 */
class Imagen extends Model
{
    use HasFactory;

    // Nombre explícito de la tabla (plural con tilde en español)
    protected $table = 'imagenes';

    // Campos asignables masivamente
    protected $fillable = [
        'ruta',      // Ruta relativa al directorio storage/app/public
        'plato_id',  // Plato al que pertenece la imagen
    ];

    // ==================== RELACIONES ====================

    /**
     * La imagen pertenece a un plato del menú.
     */
    public function plato()
    {
        return $this->belongsTo(Plato::class);
    }
}

