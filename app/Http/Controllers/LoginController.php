<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Gestiona el inicio y cierre de sesión del usuario
class LoginController extends Controller
{
    // Muestra el formulario de inicio de sesión
    public function index()
    {
        return view('login.index');
    }

    // Valida las credenciales, autentica al usuario y redirige al panel de admin (empleados) o al inicio (clientes)
    public function store(Request $request)
    {
        // Validar los campos del formulario
        $credentials = $request->validate([
            'correo' => ['required', 'email'],
            'contrasena' => ['required'],
        ], [
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'El formato del correo electrónico no es válido.',
            'contrasena.required' => 'La contraseña es obligatoria.',
        ]);

        // Intentar autenticar al usuario con las credenciales proporcionadas
        if (Auth::attempt(['correo' => $credentials['correo'], 'password' => $credentials['contrasena']])) {
            // Regenerar el ID de sesión para prevenir ataques de fijación de sesión
            $request->session()->regenerate();

            // Obtener el usuario autenticado y la URL a la que intentaba acceder
            $user = Auth::user();
            $intended = $request->session()->pull('url.intended');

            // Si es empleado (administrador), redirigir al panel de administración
            if ($user && $user->empleado) {
                return redirect()->intended(route('admin.index'));
            }

            // Si había una URL guardada y no es de admin, redirigir a ella
            if ($intended && !str_starts_with($intended, '/admin')) {
                return redirect($intended);
            }

            // Por defecto, redirigir a la página de inicio
            return redirect()->route('home');
        }

        // Si las credenciales son incorrectas, volver con error
        return back()->withErrors([
            'correo' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('correo');
    }

    // Alias de index() para compatibilidad con rutas resource
    public function create()
    {
        return $this->index();
    }

    // Cierra la sesión, invalida la cookie y regenera el token CSRF
    public function logout(Request $request)
    {
        // Desautenticar al usuario
        Auth::logout();

        // Invalidar la sesión actual y regenerar el token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
