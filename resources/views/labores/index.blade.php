<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
                <h2 class="text-2xl font-bold text-gray-700 mb-4">Registrar Nueva Labor</h2>

                <form action="{{ route('labores.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="vivero_id" class="block text-sm font-medium text-gray-700">Vivero</label>
                        <select name="vivero_id" id="vivero_id" 
                                class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                                required>
                            <option value="">Seleccione un vivero</option>
                            @foreach($viveros as $vivero)
                                <option value="{{ $vivero->id }}">
                                    {{ $vivero->codigo }} - {{ $vivero->tipo_cultivo }} 
                                    (Finca: {{ $vivero->finca->nombre }})
                                </option>
                            @endforeach
                        </select>
                        @error('vivero_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="fecha_realizacion" class="block text-sm font-medium text-gray-700">Fecha de Realización</label>
                        <input type="date" name="fecha_realizacion" id="fecha_realizacion" 
                               max="{{ date('Y-m-d') }}"
                               class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                               required>
                        @error('fecha_realizacion')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" id="descripcion" 
                                  class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                                  rows="3" required></textarea>
                        @error('descripcion')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-right">
                        <button type="submit" 
                                class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-md shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            Registrar Labor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-700">Listado de Labores</h2>
                    <a href="{{ route('labores.create') }}" 
                       class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md">
                        Nueva Labor
                    </a>
                </div>

                <div class="mb-4">
                    <form action="{{ route('labores.index') }}" method="GET" class="flex gap-4">
                        <select name="vivero_id" class="rounded-md border-gray-300 shadow-sm">
                            <option value="">Todos los viveros</option>
                            @foreach($viveros as $vivero)
                                <option value="{{ $vivero->id }}" 
                                        {{ $viveroId == $vivero->id ? 'selected' : '' }}>
                                    {{ $vivero->codigo }} - {{ $vivero->tipo_cultivo }}
                                    (Finca: {{ $vivero->finca->nombre }})
                                </option>
                            @endforeach
                        </select>
                                                <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Filtrar
                        </button>
                    </form>
                </div>

                @if(session('success'))
                    <div class="mb-4 bg-green-100 text-green-800 border border-green-300 p-4 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Fecha de Realización
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Vivero
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Descripción
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($labores as $labor)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ \Carbon\Carbon::parse($labor->fecha_realizacion)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $labor->vivero->codigo }} - {{ $labor->vivero->tipo_cultivo }} 
                                        (Finca: {{ $labor->vivero->finca->nombre }})
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $labor->descripcion }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('labores.edit', $labor->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                        <form action="{{ route('labores.destroy', $labor->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 ml-4" onclick="return confirm('¿Está seguro de eliminar esta labor?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $labores->links() }} <!-- Paginación -->
                </div>
            </div>
        </div>
    </div>   

</body>
</html>