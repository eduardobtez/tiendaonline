@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tipos de Producto</h2>
    <a href="{{ route('tipoproductos.create') }}" class="btn btn-primary mb-3">Nuevo Tipo de Producto</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tipos as $tipo)
            <tr>
                <td>{{ $tipo->id_tipoproducto }}</td>
                <td>{{ $tipo->nombre }}</td>
                <td>
                    <!-- Editar usando el objeto completo -->
                    <a href="{{ route('tipoproductos.edit', $tipo) }}" class="btn btn-warning btn-sm">Editar</a>
                    
                    <!-- Eliminar usando el objeto completo -->
                    <form action="{{ route('tipoproductos.destroy', $tipo) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar tipo de producto?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
