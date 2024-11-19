<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Producto control</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold text-gray-700 mb-4">Registrar Producto Control</h1>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-800 border border-green-300 p-4 rounded-md">
            {{ session('success') }}
        </div>
    @endif
    
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
    
    <!-- Formulario -->
    <form method="POST" action="{{ route('productor.store') }}" class="space-y-6">
        @csrf
        
        <!-- Registro ICA -->
        <div>
            <label for="registro_ica" class="block text-sm font-medium text-gray-700">Registro ICA:</label>
            <input type="text" id="registro_ica" name="registro_ica" 
                class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                required>
        </div>
        
        <!-- Nombre del Producto -->
        <div>
            <label for="nombre_producto" class="block text-sm font-medium text-gray-700">Nombre del Producto:</label>
            <input type="text" id="nombre_producto" name="nombre_producto" 
                class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                required>
        </div>
        
        <!-- Frecuencia de Aplicación -->
        <div>
            <label for="frecuencia_aplicacion" class="block text-sm font-medium text-gray-700">Frecuencia de Aplicación (días):</label>
            <input type="number" id="frecuencia_aplicacion" name="frecuencia_aplicacion"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                required>
        </div>
        
        <!-- Valor -->
        <div>
            <label for="valor" class="block text-sm font-medium text-gray-700">Valor:</label>
            <input type="number" id="valor" name="valor" step="0.01"
                class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                required>
        </div>
        
        <!-- Tipo de Control -->
        <div>
            <label for="tipo_control" class="block text-sm font-medium text-gray-700">Tipo de Control:</label>
            <select id="tipo_control" name="tipo_control" 
                class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                required>
                <option value="">Selecciona una opción</option>
                <option value="hongo">Hongo</option>
                <option value="plaga">Plaga</option>
                <option value="fertilizante">Fertilizante</option>
            </select>
        </div>
        
        <!-- Campos Dinámicos -->
        <div id="campos_dinamicos" class="space-y-4">
            <!-- Se agregarán dinámicamente con JavaScript -->
        </div>
        
        <!-- Botón -->
        <div class="text-right">
            <button type="submit" 
                class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Registrar Producto
            </button>
        </div>
    </form>

    <!-- Tabla de Registros -->
    <div class="mt-8">
        <h2 class="text-xl font-bold text-gray-700 mb-4">Productos Registrados</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                            Registro ICA
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                            Nombre
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                            Frecuencia
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                            Valor
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                            Tipo
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($productos as $producto)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $producto->registro_ica }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $producto->nombre_producto }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $producto->frecuencia_aplicacion }} días
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            ${{ number_format($producto->valor, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ ucfirst($producto->tipo_control) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('productor.edit', $producto->id) }}" 
                               class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                            <form action="{{ route('productor.destroy', $producto->id) }}" method="POST" 
                                  class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('¿Está seguro de eliminar este producto?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tipoControl = document.getElementById('tipo_control');

            if (tipoControl) {
                tipoControl.addEventListener('change', function () {
                    const camposDinamicos = document.getElementById('campos_dinamicos');
                    camposDinamicos.innerHTML = ''; // Limpia los campos dinámicos existentes

                    if (this.value === 'hongo') {
                        camposDinamicos.innerHTML = `
                            <div>
                                <label for="nombre_hongo" class="block text-sm font-medium text-gray-700">Nombre del Hongo:</label>
                                <input type="text" id="nombre_hongo" name="nombre_hongo"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        `;
                    } else if (this.value === 'plaga') {
                        camposDinamicos.innerHTML = `
                            <div>
                                <label for="periodo_carencia" class="block text-sm font-medium text-gray-700">Período de Carencia (días):</label>
                                <input type="number" id="periodo_carencia" name="periodo_carencia"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        `;
                    } else if (this.value === 'fertilizante') {
                        camposDinamicos.innerHTML = `
                            <div>
                                <label for="fecha_ultima_aplicacion" class="block text-sm font-medium text-gray-700">Fecha Última Aplicación:</label>
                                <input type="date" id="fecha_ultima_aplicacion" name="fecha_ultima_aplicacion"
                                    class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        `;
                    }
                });
            }
        });

    </script>
</body>
</html>


        
