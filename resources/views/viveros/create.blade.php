@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Registro de Vivero</h2>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('viveros.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" class="form-control @error('codigo') is-invalid @enderror" 
                           id="codigo" name="codigo" value="{{ old('codigo') }}" required>
                    @error('codigo')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tipo_cultivo" class="form-label">Tipo de Cultivo</label>
                    <input type="text" class="form-control @error('tipo_cultivo') is-invalid @enderror" 
                           id="tipo_cultivo" name="tipo_cultivo" value="{{ old('tipo_cultivo') }}" required>
                    @error('tipo_cultivo')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="finca_id" class="form-label">Finca</label>
                    <select class="form-control @error('finca_id') is-invalid @enderror" 
                            id="finca_id" name="finca_id">
                        <option value="">Seleccione una finca</option>
                        @foreach($fincas as $finca)
                            <option value="{{ $finca->id }}" {{ old('finca_id') == $finca->id ? 'selected' : '' }}>
                                {{ $finca->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('finca_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Registrar Vivero</button>
            </form>
        </div>
    </div>
</div>
@endsection