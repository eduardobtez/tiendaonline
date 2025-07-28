@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Listado de Productos</h1>
    <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Nuevo Producto</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->categoria->nombre }}</td>
                    <td>{{ $producto->tipo->nombre }}</td>
                    <td>${{ number_format($producto->precio, 2) }}</td>
                    <td>{{ $producto->activo ? 'Sí' : 'No' }}</td>
                    <td>
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este producto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
