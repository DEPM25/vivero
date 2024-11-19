<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Registrar Nueva Labor</h2>

                    <form action="{{ route('labores.store') }}" method="POST" class="max-w-md">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="vivero_id" class="block text-sm font-medium text-gray-700">Vivero</label>
                            <select name="vivero_id" id="vivero_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
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

                        <div class="mb-4">
                            <label for="fecha_realizacion" class="block text-sm font-medium text-gray-700">
                                Fecha de Realización
                            </label>
                            <input type="date" name="fecha_realizacion" id="fecha_realizacion" 
                                   max="{{ date('Y-m-d') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                   required>
                            @error('fecha_realizacion')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="descripcion" class="block text-sm font-medium text-gray-700">
                                Descripción
                            </label>
                            <textarea name="descripcion" id="descripcion" 
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" 
                                      rows="3"
                                      required></textarea>
                            @error('descripcion')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Registrar Labor
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Listado de Labores</h2>
                        <a href="{{ route('labores.create') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fecha de Realización
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Vivero
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Descripción
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($labores as $labor)
                                    <tr>
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
                                                <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Eliminar</button>
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
    </div>   
</body>
</html>