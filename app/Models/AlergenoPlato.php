<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modelo pivote de la relación many-to-many entre alérgenos y platos.
 * Representa la tabla intermedia alergeno_plato.
 */
class AlergenoPlato extends Pivot
{
    use HasFactory;

    // Nombre explícito de la tabla pivote
    protected $table = 'alergeno_plato';

    // La tabla pivote no usa timestamps (created_at / updated_at)
    public $timestamps = false;

    // Clave primaria compuesta (alergeno_id + plato_id), no autoincremental
    public $incrementing = false;
}
