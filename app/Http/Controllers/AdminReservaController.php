<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Usuario;
use Illuminate\Http\Request;


// Gestiona la creación, edición y eliminación de reservas desde el panel de admin
class AdminReservaController extends Controller
{
    // Redirige al panel de administración principal
    public function index()
    {
        return redirect()->route('admin.index');
    }

    // Muestra el formulario vacío para crear una nueva reserva
    public function create()
    {
        return view('admin.reservacreate');
    }

    // Carga la reserva indicada y muestra el formulario de edición con sus datos precargados
    public function edit($id)
    {
        $reserva = Reserva::findOrFail($id);
        return view('admin.reservacreate', compact('reserva'));
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();
        
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Reserva eliminada correctamente.']);
        }

        return redirect()->route('admin.index')->with('success', 'Reserva eliminada correctamente.');
    }

   public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // teléfono debe contener exactamente 9 dígitos
            'telefono' => ['required', 'regex:/^[0-9]{9}$/'],
            // La fecha no puede ser domingo (restaurante cerrado)
            'fecha' => ['required', 'date', function ($attribute, $value, $fail) {
                $partes = explode('-', $value);
                if (count($partes) === 3 && (int) date('N', mktime(0, 0, 0, $partes[1], $partes[2], $partes[0])) === 7) {
                    $fail('No se puede reservar en domingo. El restaurante está cerrado.');
                }
            }],
            // Solo se permiten franjas: comida 12:00-17:00 y cena 20:00-00:00 (cada 30 min)
            'hora' => 'required|in:12:00,12:30,13:00,13:30,14:00,14:30,15:00,15:30,16:00,16:30,17:00,20:00,20:30,21:00,21:30,22:00,22:30,23:00,23:30,00:00',
            // Máximo 10 comensales por reserva
            'numero_personas' => 'required|integer|min:1|max:10',
            'notas' => 'nullable|string|max:1000',
            'reserva_id' => 'nullable|integer|exists:reservas,id',
        ], [
            'nombre.required' => 'El nombre es obligatorio',
            'primer_apellido.required' => 'El primer apellido es obligatorio',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email debe ser válido',
            'telefono.required' => 'El teléfono es obligatorio',
            'telefono.regex' => 'El teléfono debe contener exactamente 9 dígitos',
            'fecha.required' => 'La fecha es obligatoria',
            'hora.required' => 'La hora es obligatoria',
            'hora.in'       => 'La hora debe estar dentro del horario del restaurante: comida (12:00–17:00) o cena (20:00–00:00)',
            'numero_personas.required' => 'El número de personas es obligatorio',
            'numero_personas.min' => 'Mínimo 1 persona',
            'numero_personas.max' => 'Máximo 10 personas por reserva',
        ]);

        // Si es una actualización
        if ($request->has('reserva_id') && $request->input('reserva_id')) {
            $reserva = Reserva::findOrFail($request->input('reserva_id'));
            $usuario = $reserva->usuario;
            
            // Actualizar datos del usuario
            $usuario->update([
                'nombre' => $validated['nombre'],
                'primer_apellido' => $validated['primer_apellido'],
                'correo' => $validated['email'],
                'telefono' => $validated['telefono'],
            ]);
            
            // Actualizar datos de la reserva
            $reserva->update([
                'fecha' => $validated['fecha'],
                'hora' => $validated['hora'],
                'numero_personas' => $validated['numero_personas'],
                'notas' => $validated['notas'] ?? null,
            ]);
            
            return redirect()->route('admin.index')->with('success', 'Reserva actualizada correctamente.');
        }

        // Si es una creación nueva
        $usuario = Usuario::where('correo', $validated['email'])->first();
        
        if (!$usuario) {
            $usuario = Usuario::create([
                'nombre' => $validated['nombre'],
                'primer_apellido' => $validated['primer_apellido'],
                'correo' => $validated['email'],
                'telefono' => $validated['telefono'],
                'contrasena' => bcrypt('temporal'),
            ]);
        }

        // Crear la reserva con estado pendiente por defecto
        $reserva = Reserva::create([
            'usuario_id' => $usuario->id,
            'fecha' => $validated['fecha'],
            'hora' => $validated['hora'],
            'numero_personas' => $validated['numero_personas'],
            'notas' => $validated['notas'] ?? null,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('admin.index')->with('success', 'Reserva creada correctamente.');
    }
}
