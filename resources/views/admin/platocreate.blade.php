@extends('pagina.layouts.plantilla_admin')
@section('title', 'Creacion de platos| Surprise Burger')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-white to-blue-100 p-4 sm:p-6 lg:p-8">

    <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden">

        <!-- Alertas -->
        @include('components.alert')

        <!-- Header -->
        <div class="bg-[#1E3D9A] px-8 py-10 md:px-12 md:py-12">
            <h1 class="text-3xl md:text-4xl lg:text-5xl text-white text-center mb-2">
                @if(isset($plato)) Editar Plato @else Crear Plato @endif
            </h1>
            <p class="text-blue-100 text-center text-sm md:text-base">
                Gestiona los platos
            </p>
        </div>

        <!-- FORMULARIO -->
        <form 
            action="{{ isset($plato) ? route('admin_platos.update', $plato->id) : route('admin_platos.store') }}" 
            method="POST" 
            enctype="multipart/form-data"
            class="px-8 py-10 md:px-12 md:py-12 space-y-8"
        >
            @csrf
            @if(isset($plato))
                @method('PUT')
            @endif

            <!-- Nombre -->
            <div class="group">
                <label class="block mb-3 text-sm font-bold text-gray-700 flex items-center gap-2">
                    <i class="bi bi-card-text text-[#1E3D9A]"></i>
                    Nombre del plato
                </label>
                <input
                    type="text"
                    name="nombre"
                    required
                    placeholder="Hamburguesa BBQ"
                    class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 focus:outline-none focus:border-[#1E3D9A] focus:ring-4 focus:ring-blue-100 @error('nombre') border-red-500 @enderror"
                    value="{{ old('nombre', $plato->nombre ?? '') }}"
                />
                @error('nombre')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Descripción -->
            <div class="group">
                <label class="block mb-3 text-sm font-bold text-gray-700 flex items-center gap-2">
                    <i class="bi bi-chat-left-text-fill text-[#1E3D9A]"></i>
                    Descripción
                </label>
                <textarea
                    name="descripcion"
                    rows="4"
                    required
                    class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 resize-none focus:outline-none focus:border-[#1E3D9A] focus:ring-4 focus:ring-blue-100 @error('descripcion') border-red-500 @enderror"
                    placeholder="Descripción del plato..."
                >{{ old('descripcion', $plato->descripcion ?? '') }}</textarea>
                @error('descripcion')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Precio -->
            <div class="group">
                <label class="block mb-3 text-sm font-bold text-gray-700 flex items-center gap-2">
                    <i class="bi bi-currency-euro text-[#1E3D9A]"></i>
                    Precio
                </label>
                <input
                    type="number"
                    name="precio"
                    step="0.01"
                    min="0"
                    required
                    placeholder="9.99"
                    class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 focus:outline-none focus:border-[#1E3D9A] focus:ring-4 focus:ring-blue-100 @error('precio') border-red-500 @enderror"
                    value="{{ old('precio', $plato->precio ?? '') }}"
                />
                @error('precio')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Activo -->
            <div class="group">
                <label class="block mb-3 text-sm font-bold text-gray-700 flex items-center gap-2">
                    <i class="bi bi-toggle-on text-[#1E3D9A]"></i>
                    Estado
                </label>
                <select
                    name="activo"
                    required
                    class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 focus:outline-none focus:border-[#1E3D9A] focus:ring-4 focus:ring-blue-100"
                >
                    <option value="1" class="text-green-600 font-bold" {{ (old('activo', $plato->activo ?? 1) == 1) ? 'selected' : '' }}>Activo</option>
                    <option value="0" class="text-red-600 font-bold" {{ (old('activo', $plato->activo ?? 1) == 0) ? 'selected' : '' }}>Inactivo</option>
                </select>
                @error('activo')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Imagen -->
            <div class="group">
                <label class="block mb-3 text-sm font-bold text-gray-700 flex items-center gap-2">
                    <i class="bi bi-image-fill text-[#1E3D9A]"></i>
                    Imagen del plato
                </label>

                {{-- Vista previa de la imagen actual --}}
                @if(isset($plato) && $plato->imagenes->first())
                    <div class="mb-4">
                        <p class="text-xs text-gray-500 mb-2">Imagen actual:</p>
                        <img 
                            src="{{ asset('storage/' . $plato->imagenes->first()->ruta) }}" 
                            alt="{{ $plato->nombre }}" 
                            class="w-32 h-32 object-cover rounded-xl shadow-md border-2 border-gray-100"
                        >
                    </div>
                @endif
                <input
                    type="file"
                    name="imagen"
                    accept="image/*"
                    class="w-full border-2 border-gray-300 rounded-xl px-5 py-4"
                />
                @error('imagen')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Categoría -->
            <div class="group">
                <label class="block mb-3 text-sm font-bold text-gray-700 flex items-center gap-2">
                    <i class="bi bi-tags-fill text-[#1E3D9A]"></i>
                    Categoría
                </label>
                <select
                    name="categoria_id"
                    required
                    class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 focus:outline-none focus:border-[#1E3D9A] focus:ring-4 focus:ring-blue-100"
                >
                    <option value="">Selecciona una categoría</option>
                    @foreach($categorias as $categoria)
                        <option 
                            value="{{ $categoria->id }}"
                            {{ (old('categoria_id', $plato->categoria_id ?? '') == $categoria->id) ? 'selected' : '' }}
                        >
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Alérgenos -->
            <div class="group">
                <label class="block mb-3 text-sm font-bold text-gray-700 flex items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill text-[#1E3D9A]"></i>
                    Alérgenos
                </label>
                <select
                    name="alergenos[]"
                    multiple
                    class="w-full border-2 border-gray-300 rounded-xl px-5 py-4 focus:outline-none focus:border-[#1E3D9A] focus:ring-4 focus:ring-blue-100"
                >
                    @foreach($alergenos as $alergeno)
                        <option 
                            value="{{ $alergeno->id }}"
                            @if(isset($plato) && $plato->alergenos->contains($alergeno->id)) selected @endif
                        >
                            {{ $alergeno->nombre }}
                        </option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-500 mt-2">Ctrl / Cmd para seleccionar varios</p>
            </div>

            <!-- Botón -->
            <button
                type="submit"
                class="w-full bg-[#1E3D9A] text-white py-5 rounded-xl text-lg font-bold hover:bg-[#152d73] transition shadow-lg flex items-center justify-center gap-3"
            >
                <i class="bi bi-check-circle-fill"></i>
                @if(isset($plato)) Actualizar plato @else Crear plato @endif
            </button>

        </form>
    </div>
</div>

@endsection