@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Clientes</h1>

    <a href="{{ route('cliente.create') }}" class="btn btn-primary mb-3">Nuevo Cliente</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse($clientes as $cliente)
            <tr>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>
                    <a href="{{ route('cliente.show', $cliente->id) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('¿Estás seguro de eliminar este cliente?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">No hay clientes registrados.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
