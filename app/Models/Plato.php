<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo que representa un plato del menú del restaurante.
 * Incluye nombre, descripción, precio, estado activo/inactivo y relaciones
 * con categoría, alérgenos, imágenes y pedidos.
 */
class Plato extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'activo',        // Indica si el plato está disponible en el menú
        'categoria_id',  // Clave foránea a la tabla de categorías
    ];

    // Conversiones automáticas de tipos de datos
    protected $casts = [
        'activo' => 'boolean',    // Se trata como booleano en PHP
        'precio' => 'decimal:2',  // Se formatea con 2 decimales
    ];

    // ==================== RELACIONES ====================

    /**
     * Un plato pertenece a una categoría (ej: Entrantes, Principales, Postres).
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Un plato puede tener muchos alérgenos (relación muchos a muchos).
     * Tabla pivot: alergeno_plato
     */
    public function alergenos()
    {
        return $this->belongsToMany(Alergeno::class, 'alergeno_plato', 'plato_id', 'alergeno_id');
    }

    /**
     * Un plato puede aparecer en muchos pedidos (relación muchos a muchos).
     * Tabla pivot: pedido_plato (incluye la cantidad pedida)
     */
    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedido_plato', 'plato_id', 'pedido_id')->withPivot('cantidad');
    }

    /**
     * Un plato puede tener varias imágenes asociadas.
     */
    public function imagenes()
    {
        return $this->hasMany(Imagen::class);
    }
}

