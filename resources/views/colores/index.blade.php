@extends('layouts.app')

@section('title', 'Colores')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Colores</h1>
    <a href="{{ route('colores.create') }}" class="btn btn-primary">Nuevo Color</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Código Hex</th>
            <th>Imagen</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($colores as $color)
            <tr>
                <td>{{ $color->id }}</td>
                <td>{{ $color->nombre }}</td>
                <td>
                    {{ $color->codigo_hex }}
                    @if($color->codigo_hex)
                        <span style="display:inline-block;width:20px;height:20px;background:{{ $color->codigo_hex }};border:1px solid #ccc;margin-left:5px;"></span>
                    @endif
                </td>
                <td>
                    @if($color->imagen_url)
                        <img src="{{ $color->imagen_url }}" alt="Imagen" style="width:40px;height:40px;object-fit:cover;">
                    @else
                        -
                    @endif
                </td>
                <td class="text-center">
                    <a href="{{ route('colores.show', $color) }}" class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('colores.edit', $color) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('colores.destroy', $color) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('¿Eliminar este color?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center">No hay colores registrados.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $colores->links() }}
@endsection
