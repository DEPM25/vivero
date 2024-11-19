<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto control</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold text-gray-700 mb-4">Editar Producto Control</h1>

    <!-- Mensajes de error -->
    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-800 border border-red-300 p-4 rounded-md">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Mensajes de éxito -->
    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-800 border border-green-300 p-4 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulario -->
    <form method="POST" action="{{ route('productos.update', $producto->id) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Registro ICA -->
        <div>
            <label for="registro_ica" class="block text-sm font-medium text-gray-700">Registro ICA:</label>
            <input type="text" 
                   id="registro_ica" 
                   name="registro_ica" 
                   value="{{ old('registro_ica', $producto->registro_ica) }}"
                   class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                   required>
        </div>

        <!-- Nombre del Producto -->
        <div>
            <label for="nombre_producto" class="block text-sm font-medium text-gray-700">Nombre del Producto:</label>
            <input type="text" 
                   id="nombre_producto" 
                   name="nombre_producto"
                   value="{{ old('nombre_producto', $producto->nombre_producto) }}"
                   class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                   required>
        </div>

        <!-- Frecuencia de Aplicación -->
        <div>
            <label for="frecuencia_aplicacion" class="block text-sm font-medium text-gray-700">Frecuencia de Aplicación (días):</label>
            <input type="number" 
                   id="frecuencia_aplicacion" 
                   name="frecuencia_aplicacion"
                   value="{{ old('frecuencia_aplicacion', $producto->frecuencia_aplicacion) }}"
                   class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                   required>
        </div>

        <!-- Valor -->
        <div>
            <label for="valor" class="block text-sm font-medium text-gray-700">Valor:</label>
            <input type="number" 
                   id="valor" 
                   name="valor" 
                   step="0.01"
                   value="{{ old('valor', $producto->valor) }}"
                   class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                   required>
        </div>

        <!-- Tipo de Control -->
        <div>
            <label for="tipo_control" class="block text-sm font-medium text-gray-700">Tipo de Control:</label>
            <select id="tipo_control" 
                    name="tipo_control"
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    required>
                <option value="">Selecciona una opción</option>
                <option value="hongo" {{ old('tipo_control', $producto->tipo_control) == 'hongo' ? 'selected' : '' }}>
                    Hongo
                </option>
                <option value="plaga" {{ old('tipo_control', $producto->tipo_control) == 'plaga' ? 'selected' : '' }}>
                    Plaga
                </option>
                <option value="fertilizante" {{ old('tipo_control', $producto->tipo_control) == 'fertilizante' ? 'selected' : '' }}>
                    Fertilizante
                </option>
            </select>
        </div>

        <!-- Botones -->
        <div class="flex justify-between items-center m-4">
            <a href="{{ route('productos.index') }}" 
               class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-md shadow hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                Cancelar
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Actualizar Producto
            </button>
        </div>
    </form>
</div>

<!-- Script para campos dinámicos -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tipoControl = document.getElementById('tipo_control');
    const camposDinamicos = document.getElementById('campos_dinamicos');
    
    // Función para generar campos dinámicos
    function generarCamposDinamicos(tipo, valoresExistentes = {}) {
        camposDinamicos.innerHTML = ''; // Limpia los campos dinámicos existentes
        
        if (tipo === 'hongo') {
            camposDinamicos.innerHTML = `
                <div>
                    <label for="nombre_hongo" class="block text-sm font-medium text-gray-700">Nombre del Hongo:</label>
                    <input type="text" 
                           id="nombre_hongo" 
                           name="nombre_hongo"
                           value="${valoresExistentes.nombre_hongo || ''}"
                           class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            `;
        } else if (tipo === 'plaga') {
            camposDinamicos.innerHTML = `
                <div>
                    <label for="periodo_carencia" class="block text-sm font-medium text-gray-700">Período de Carencia (días):</label>
                    <input type="number" 
                           id="periodo_carencia" 
                           name="periodo_carencia"
                           value="${valoresExistentes.periodo_carencia || ''}"
                           class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            `;
        } else if (tipo === 'fertilizante') {
            camposDinamicos.innerHTML = `
                <div>
                    <label for="fecha_ultima_aplicacion" class="block text-sm font-medium text-gray-700">Fecha Última Aplicación:</label>
                    <input type="date" 
                           id="fecha_ultima_aplicacion" 
                           name="fecha_ultima_aplicacion"
                           value="${valoresExistentes.fecha_ultima_aplicacion || ''}"
                           class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            `;
        }
    }

    if (tipoControl) {
        // Cargar campos dinámicos iniciales basados en el valor actual
        const valoresIniciales = {
            nombre_hongo: '{{ $producto->nombre_hongo ?? "" }}',
            periodo_carencia: '{{ $producto->periodo_carencia ?? "" }}',
            fecha_ultima_aplicacion: '{{ $producto->fecha_ultima_aplicacion ?? "" }}'
        };
        
        // Generar campos iniciales si hay un tipo seleccionado
        if (tipoControl.value) {
            generarCamposDinamicos(tipoControl.value, valoresIniciales);
        }

        // Escuchar cambios futuros
        tipoControl.addEventListener('change', function () {
            generarCamposDinamicos(this.value, {});
        });
    }
});
</script>