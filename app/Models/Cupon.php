<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que representa un cupón canjeable del programa de recompensas.
 * Los usuarios acumulan puntos al comprar y pueden canjearlos por cupones.
 */
class Cupon extends Model
{
    use HasFactory;

    // Nombre explícito de la tabla (plural irregular en español)
    protected $table = 'cupones';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',             // Nombre descriptivo del cupón
        'imagenes',           // Ruta o URL de la imagen del cupón
        'puntos_necesarios',  // Puntos de fidelidad requeridos para canjear
    ];

    // ==================== RELACIONES ====================

    /**
     * Un cupón puede estar asociado a varios registros de puntos
     * (cuando los usuarios lo canjean, se genera un registro negativo de puntos).
     */
    public function puntos()
    {
        return $this->hasMany(Punto::class);
    }
}
