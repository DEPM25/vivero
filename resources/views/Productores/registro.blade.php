<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Productor</title>
    <!-- CDNs para estilos y funcionalidades -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Contenedor principal con centrado vertical y horizontal -->
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <!-- Tarjeta del formulario -->
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-lg">
            <!-- Encabezado del formulario -->
            <div>
                <h2 class="text-center text-3xl font-extrabold text-gray-900">
                    Registro de Productor
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Complete el formulario con sus datos
                </p>
            </div>

            <!-- Mensaje de éxito - Se muestra cuando la operación es exitosa -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Mensajes de error - Muestra errores de validación del servidor -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulario principal -->
            <form class="mt-8 space-y-6" action="{{ route('productores.store') }}" method="POST" id="producatorForm">
                @csrf
                <div class="rounded-md shadow-sm space-y-4">
                    <!-- Campo: Documento de Identidad -->
                    <div>
                        <label for="documento_identidad" class="block text-sm font-medium text-gray-700">
                            Documento de Identidad
                        </label>
                        <input type="text" 
                               name="documento_identidad" 
                               id="documento_identidad" 
                               required
                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border"
                               placeholder="Ingrese su documento">
                    </div>

                    <!-- Campo: Nombre - Solo permite letras -->
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700">
                            Nombre
                        </label>
                        <input type="text" 
                               name="nombre" 
                               id="nombre" 
                               required
                               pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+"
                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border"
                               placeholder="Ingrese su nombre"
                               oninput="validateLettersOnly(this)"
                               title="Solo se permiten letras">
                        <span class="text-red-500 text-xs hidden" id="nombreError">Solo se permiten letras</span>
                    </div>

                    <!-- Campo: Apellido - Solo permite letras -->
                    <div>
                        <label for="apellido" class="block text-sm font-medium text-gray-700">
                            Apellido
                        </label>
                        <input type="text" 
                               name="apellido" 
                               id="apellido" 
                               required
                               pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+"
                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border"
                               placeholder="Ingrese su apellido"
                               oninput="validateLettersOnly(this)"
                               title="Solo se permiten letras">
                        <span class="text-red-500 text-xs hidden" id="apellidoError">Solo se permiten letras</span>
                    </div>

                    <!-- Campo: Teléfono - Validación de 9 dígitos -->
                    <div>
                        <label for="telefono" class="block text-sm font-medium text-gray-700">
                            Teléfono
                        </label>
                        <div class="relative">
                            <input type="tel" 
                                   name="telefono" 
                                   id="telefono" 
                                   required
                                   pattern="[0-9]{9}"
                                   maxlength="9"
                                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border"
                                   placeholder="Ejemplo: 987654321"
                                   oninput="validatePhone(this)">
                            <span class="text-red-500 text-xs hidden" id="telefonoError">
                                El teléfono debe contener 9 dígitos numéricos
                            </span>
                        </div>
                        <span class="text-gray-500 text-xs">Formato: 9 dígitos sin espacios ni guiones</span>
                    </div>

                    <!-- Campo: Correo Electrónico -->
                    <div>
                        <label for="correo" class="block text-sm font-medium text-gray-700">
                            Correo Electrónico
                        </label>
                        <input type="email" 
                               name="correo" 
                               id="correo" 
                               required
                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border"
                               placeholder="ejemplo@correo.com">
                    </div>
                </div>

                <!-- Botón de envío -->
                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Registrar Productor
                    </button>
                </div>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                            Documento de Identidad
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                            Nombre
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                            Apellido
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                            Teléfono
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                            Correo Electrónico
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($productores as $productor)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $productor->documento_identidad }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $productor->nombre }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $productor->apellido }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $productor->telefono }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $productor->correo }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('productores.edit', $productor->id) }}" 
                                    class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                                <form action="{{ route('productores.destroy', $productor->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('¿Está seguro de eliminar este productor?')">
                                        Eliminar
                                    </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>

            <!-- Paginación (si es necesario) -->
            <div class="mt-4">
                {{ $productores->links() }} <!-- Esto es para la paginación -->
            </div>
        </div>
    </div>

    <script>
        // Función para validar que solo se ingresen letras
        function validateLettersOnly(input) {
            const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*$/;
            const errorElement = document.getElementById(input.id + 'Error');
            
            if (!regex.test(input.value)) {
                // Elimina caracteres no permitidos y muestra error
                input.value = input.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
                errorElement.classList.remove('hidden');
            } else {
                errorElement.classList.add('hidden');
            }
        }

        // Función para validar el formato del teléfono
        function validatePhone(input) {
            // Elimina caracteres no numéricos
            input.value = input.value.replace(/[^0-9]/g, '');
            
            const errorElement = document.getElementById('telefonoError');
            const regex = /^[0-9]{9}$/;
            
            // Muestra/oculta mensaje de error según validación
            if (!regex.test(input.value)) {
                errorElement.classList.remove('hidden');
            } else {
                errorElement.classList.add('hidden');
            }
        }

        // Validación del formulario antes de enviar
        document.getElementById('producatorForm').addEventListener('submit', function(event) {
            const nombre = document.getElementById('nombre');
            const apellido = document.getElementById('apellido');
            const telefono = document.getElementById('telefono');
            
            // Expresiones regulares para validación
            const letrasRegex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
            const telefonoRegex = /^[0-9]{9}$/;

            // Validación de nombre y apellido
            if (!letrasRegex.test(nombre.value) || !letrasRegex.test(apellido.value)) {
                event.preventDefault();
                alert('Por favor, asegúrese de que el nombre y apellido solo contengan letras.');
                return;
            }

            // Validación de teléfono
            if (!telefonoRegex.test(telefono.value)) {
                event.preventDefault();
                alert('Por favor, ingrese un número de teléfono válido de 9 dígitos.');
                return;
            }
        });
    </script>
</body>
</html>