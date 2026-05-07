<?php

namespace App\Http\Controllers;

use App\Models\Plato;
use App\Models\Categoria;
use App\Models\Alergeno;
use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// Gestiona la creación, edición y eliminación de platos del menú desde el panel de admin
class AdminPlatoController extends Controller
{
    // Redirige al panel de administración principal
    public function index()
    {
        return redirect()->route('admin.index');
    }

    // Muestra el formulario para crear un nuevo plato con todas las categorías y alérgenos disponibles
    public function create()
    {
        $categorias = Categoria::all();
        $alergenos = Alergeno::all();
        return view('admin.platocreate', compact('categorias', 'alergenos'));
    }

    //Almacena un nuevo plato
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'alergenos' => 'nullable|array',
            'alergenos.*' => 'exists:alergenos,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'activo' => 'boolean',
        ]);

        $plato = Plato::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'categoria_id' => $request->categoria_id,
            'activo' => $request->input('activo', true), // por defecto activo
        ]);

        // Asociar alérgenos
        if ($request->has('alergenos')) {
            $plato->alergenos()->sync($request->alergenos);
        }

        // Guardar imagen si se proporciona
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('platos', 'public');
            Imagen::create([
                'plato_id' => $plato->id,
                'ruta' => $path,
            ]);
        }

        return redirect()->route('admin.index')->with('success', 'Plato creado correctamente.');
    }

    //Muestra un formulario para editar un plato
    public function edit($id)
    {
        $plato = Plato::findOrFail($id);
        $categorias = Categoria::all();
        $alergenos = Alergeno::all();
        return view('admin.platocreate', compact('plato', 'categorias', 'alergenos'));
    }

    //Actualiza un plato existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'alergenos' => 'nullable|array',
            'alergenos.*' => 'exists:alergenos,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'activo' => 'boolean',
        ]);

        $plato = Plato::findOrFail($id);
        $plato->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'categoria_id' => $request->categoria_id,
            'activo' => $request->input('activo', $plato->activo),
        ]);

        // Sincronizar alérgenos
        $plato->alergenos()->sync($request->alergenos ?? []);

        // Guardar imagen si se proporciona
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            $imagenAnterior = $plato->imagenes()->first();
            if ($imagenAnterior) {
                Storage::disk('public')->delete($imagenAnterior->ruta);
                $imagenAnterior->delete();
            }
            
            // Guardar nueva imagen
            $path = $request->file('imagen')->store('platos', 'public');
            Imagen::create([
                'plato_id' => $plato->id,
                'ruta' => $path,
            ]);
        }

        return redirect()->route('admin.index')->with('success', 'Plato actualizado correctamente.');
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $plato = Plato::findOrFail($id);
        
        // Eliminar todas las imágenes asociadas
        foreach ($plato->imagenes as $imagen) {
            Storage::disk('public')->delete($imagen->ruta);
            $imagen->delete();
        }
        
        $plato->delete();
        
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Plato eliminado correctamente.']);
        }

        return redirect()->route('admin.index')->with('success', 'Plato eliminado correctamente.');
    }
}
