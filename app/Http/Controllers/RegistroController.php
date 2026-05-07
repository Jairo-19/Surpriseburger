<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller
{
    // Muestra el formulario de registro
    public function index()
    {
        return view('login.registro');
    }

    // Valida los datos, crea el usuario y su perfil de cliente, e inicia sesión automáticamente
    public function store(Request $request)
    {
        // 1. Validar los datos
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'primer_apellido' => ['required', 'string', 'max:255'],
            'segundo_apellido' => ['nullable', 'string', 'max:255'],
            // teléfono debe contener exactamente 9 dígitos
            'telefono' => ['nullable', 'regex:/^[0-9]{9}$/'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
            'contrasena' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'primer_apellido.required' => 'El primer apellido es obligatorio.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'El formato del correo no es válido.',
            'correo.unique' => 'Este correo ya está registrado.',
            'contrasena.required' => 'La contraseña es obligatoria.',
            'contrasena.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'contrasena.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        // 2. Crear el usuario
        $usuario = Usuario::create([
            'nombre' => $validated['nombre'],
            'primer_apellido' => $validated['primer_apellido'],
            'segundo_apellido' => $validated['segundo_apellido'] ?? null,
            'telefono' => $validated['telefono'] ?? null,
            'correo' => $validated['correo'],
            'contrasena' => Hash::make($validated['contrasena']),
        ]);

        // 3. Crear el registro de cliente asociado
        Cliente::create([
            'usuario_id' => $usuario->id,
        ]);

        // 4. Iniciar sesión automáticamente
        Auth::login($usuario);

        // 5. Redirigir al usuario a la página de inicio
        return redirect()->route('home')->with('success', '¡Registro completado con éxito!');
    }
}
