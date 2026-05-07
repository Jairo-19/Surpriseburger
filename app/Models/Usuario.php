<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Modelo de usuario del sistema (tanto clientes como empleados/administradores).
 * Extiende Authenticatable para usar el sistema de autenticación de Laravel,
 * usando 'correo' y 'contrasena' en lugar de los campos por defecto.
 */
class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Sobreescribe el nombre del campo de contraseña para la autenticación.
     * Laravel usa 'password' por defecto; aquí usamos 'contrasena'.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'telefono',
        'correo',
        'contrasena',
    ];

    // Campos ocultos (no se exponen en JSON ni en arrays)
    protected $hidden = [
        'contrasena',
    ];

    // ==================== RELACIONES ====================

    /**
     * Un usuario puede realizar múltiples pedidos.
     */
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    /**
     * Un usuario puede ser cliente (tiene perfil de cliente asociado).
     */
    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'usuario_id');
    }

    /**
     * Un usuario puede ser empleado/administrador.
     * Si esta relación devuelve algo, el usuario tiene acceso al panel de admin.
     */
    public function empleado()
    {
        return $this->hasOne(Empleado::class, 'usuario_id');
    }

    /**
     * Los puntos de fidelidad del usuario (gana puntos al comprar, los gasta con cupones).
     */
    public function puntos()
    {
        return $this->hasMany(Punto::class, 'cliente_id');
    }

    /**
     * Las reseñas escritas por el usuario.
     */
    public function resenas()
    {
        return $this->hasMany(Resena::class, 'cliente_id');
    }

    /**
     * Las reservas de mesa del usuario.
     */
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
