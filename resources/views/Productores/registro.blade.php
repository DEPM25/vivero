<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Productor</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-lg">
            <div>
                <h2 class="text-center text-3xl font-extrabold text-gray-900">
                    Registro de Productor
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Complete el formulario con sus datos
                </p>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ route('productores.store') }}" method="POST" id="producatorForm">
                @csrf
                <div class="rounded-md shadow-sm space-y-4">
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

                    <div>
                        <label for="telefono" class="block text-sm font-medium text-gray-700">
                            Teléfono
                        </label>
                        <input type="tel" 
                               name="telefono" 
                               id="telefono" 
                               required
                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border"
                               placeholder="Ingrese su teléfono">
                    </div>

                    <div>
                        <label for="correo" class="block text-sm font-medium text-gray-700">
                            Correo Electrónico
                        </label>
                        <input type="email" 
                               name="correo" 
                               id="correo" 
                               required
                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md p-2 border"
                               placeholder="Ingrese su correo">
                    </div>
                </div>

                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Registrar Productor
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validateLettersOnly(input) {
            // Expresión regular que permite solo letras (incluyendo acentos y ñ) y espacios
            const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*$/;
            const errorElement = document.getElementById(input.id + 'Error');
            
            if (!regex.test(input.value)) {
                // Si hay números o caracteres especiales, eliminarlos
                input.value = input.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
                errorElement.classList.remove('hidden');
            } else {
                errorElement.classList.add('hidden');
            }
        }

        // Validación adicional antes de enviar el formulario
        document.getElementById('producatorForm').addEventListener('submit', function(event) {
            const nombre = document.getElementById('nombre');
            const apellido = document.getElementById('apellido');
            const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;

            if (!regex.test(nombre.value) || !regex.test(apellido.value)) {
                event.preventDefault();
                alert('Por favor, asegúrese de que el nombre y apellido solo contengan letras.');
            }
        });
    </script>
</body>
</html>