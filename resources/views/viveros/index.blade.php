@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Listado de Viveros</h2>
            <a href="{{ route('viveros.create') }}" class="btn btn-primary">Nuevo Vivero</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Tipo de Cultivo</th>
                            <th>Municipio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($viveros as $vivero)
                        <tr>
                            <td>{{ $vivero->codigo }}</td>
                            <td>{{ $vivero->tipo_cultivo }}</td>
                            <td>{{ $vivero->finca->municipio }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection