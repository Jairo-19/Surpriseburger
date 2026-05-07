<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use App\Models\Imagen;
use Illuminate\Http\Request;

/**
 * Controlador de administración de cupones del programa de recompensas.
 * Permite crear, editar, actualizar y eliminar cupones desde el panel de admin.
 */
class AdminCuponController extends Controller
{
    // Redirige a la página principal del administrador (lista completa)
    public function index()
    {
        return redirect()->route('admin.index');
    }

    // formulario de creación de cupones
    public function create()
    {
        return view('admin.cuponcreate');
    }

    // guarda un nuevo cupón en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'puntos_necesarios' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Crear el cupón. La tabla tiene columna 'imagenes' que guarda ruta
        $cupon = Cupon::create([
            'nombre' => $request->nombre,
            'puntos_necesarios' => $request->puntos_necesarios,
        ]);

        // subir imagen si se proporciona y guardar ruta en la columna
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('cupones', 'public');
            $cupon->imagenes = $path;
            $cupon->save();
        }

        return redirect()->route('admin.index')->with('success', 'Cupón creado correctamente.');
    }

    // formulario de edición de cupón existente
    public function edit($id)
    {
        $cupon = Cupon::findOrFail($id);
        return view('admin.cuponcreate', compact('cupon'));
    }

    // actualiza un cupón existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'puntos_necesarios' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $cupon = Cupon::findOrFail($id);
        $cupon->update([
            'nombre' => $request->nombre,
            'puntos_necesarios' => $request->puntos_necesarios,
        ]);

        // si se sube imagen nueva, reemplazar la ruta en el registro
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('cupones', 'public');
            $cupon->imagenes = $path;
            $cupon->save();
        }

        return redirect()->route('admin.index')->with('success', 'Cupón actualizado correctamente.');
    }

    // elimina un cupón (desde lista de admin)
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $cupon = Cupon::findOrFail($id);
        $cupon->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Cupón eliminado correctamente.']);
        }

        return redirect()->route('admin.index')->with('success', 'Cupón eliminado correctamente.');
    }
}
