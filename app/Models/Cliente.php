<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cupon;

/**
 * Modelo que representa el perfil de cliente de un usuario registrado.
 * Extiende al modelo Usuario con datos específicos de cliente (fecha registro, puntos, reseñas).
 * Usa usuario_id como clave primaria (relación 1:1 con Usuario).
 */
class Cliente extends Model
{
    use HasFactory;

    // Clave primaria es usuario_id (no id autoincremental)
    protected $primaryKey = 'usuario_id';

    // La PK no es autoincremental ya que coincide con la del usuario
    public $incrementing = false;

    // Campos asignables masivamente
    protected $fillable = [
        'usuario_id',       // Referencia al usuario autenticable
        'fecha_registro',   // Fecha en que se registró como cliente
    ];

    // Conversión automática de tipos
    protected $casts = [
        'fecha_registro' => 'datetime',
    ];

    // ==================== RELACIONES ====================

    /**
     * El cliente pertenece a un usuario (autenticable).
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    /**
     * El cliente tiene muchos registros de puntos de fidelidad.
     */
    public function puntos()
    {
        return $this->hasMany(Punto::class, 'cliente_id', 'usuario_id');
    }

    /**
     * El cliente puede escribir muchas reseñas del restaurante.
     */
    public function resenas()
    {
        return $this->hasMany(Resena::class, 'cliente_id', 'usuario_id');
    }

    /**
     * Relación many-to-many con cupones canjeados por el cliente.
     * La tabla pivote `cliente_cupon` almacena qué cupones ha adquirido.
     */
    public function cupones()
    {
        return $this->belongsToMany(Cupon::class, 'cliente_cupon', 'cliente_id', 'cupon_id');
    }
}
