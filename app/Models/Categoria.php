<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que representa una categoría del menú (ej. Hamburguesas, Bebidas, Postres).
 */
class Categoria extends Model
{
    use HasFactory;

    // Campos asignables masivamente
    protected $fillable = [
        'nombre',       // Nombre de la categoría que aparece en el menú
        'descripcion',  // Descripción opcional de la categoría
        'imagen',       // Ruta de la imagen representativa de la categoría
    ];

    // ==================== RELACIONES ====================

    /**
     * Una categoría tiene muchos platos en el menú.
     */
    public function platos()
    {
        return $this->hasMany(Plato::class);
    }
}

