@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Variantes</h1>

    <a href="{{ route('variantes.create') }}" class="btn btn-primary mb-3">Nueva Variante</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-dark table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Color</th>
                    <th>Talle</th>
                    <th>Código de barra</th>
                    <th>Stock</th>
                    <th>Peso (g)</th>
                    <th>Imagen</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($variantes as $v)
                <tr>
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->producto->nombre ?? '-' }}</td>
                    <td>{{ $v->color->nombre ?? '-' }}</td>
                    <td>{{ $v->talle->nombre ?? '-' }}</td>
                    <td>{{ $v->codigo_barra ?? '-' }}</td>
                    <td>{{ $v->stock }}</td>
                    <td>{{ $v->peso ?? '-' }}</td>
                    <td>
                        @forelse($v->imagenes as $img)
                            <img src="{{ asset('storage/' . $img->imagen_url) }}" 
                                 class="img-thumbnail me-1 mb-1" style="max-height: 80px;">
                        @empty
                            -
                        @endforelse
                    </td>

                    <td class="text-end">
                        <a href="{{ route('variantes.show', $v) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('variantes.edit', $v) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('variantes.destroy', $v) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar variante?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9">No hay variantes cargadas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $variantes->links() }}
</div>
@endsection
