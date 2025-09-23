@extends('layouts.app')

@section('title', 'Talles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Talles</h1>
    <a href="{{ route('talles.create') }}" class="btn btn-primary">Nuevo Talle</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-striped table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($talles as $talle)
            <tr>
                <td>{{ $talle->id }}</td>
                <td>{{ $talle->nombre }}</td>
                <td class="text-center">
                    <a href="{{ route('talles.show', $talle) }}" class="btn btn-sm btn-info">Ver</a>
                    <a href="{{ route('talles.edit', $talle) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('talles.destroy', $talle) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('¿Eliminar este talle?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3" class="text-center">No hay talles registrados.</td></tr>
        @endforelse
    </tbody>
</table>

{{ $talles->links() }}
@endsection
