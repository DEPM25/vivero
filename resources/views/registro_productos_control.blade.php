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
    <form method="POST" action="{{ route('productos.store') }}" class="space-y-6">
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


        
