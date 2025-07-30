@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Envíos</h1>
    <a href="{{ route('envio.create') }}" class="btn btn-primary mb-3">Registrar Envío</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pedido</th>
                <th>Estado</th>
                <th>Empresa</th>
                <th>N° Seguimiento</th>
                <th>Fecha Envío</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($envios as $envio)
            <tr>
                <td>{{ $envio->id }}</td>
                <td>#{{ $envio->pedido_id }}</td>
                <td>{{ $envio->estado_envio }}</td>
                <td>{{ $envio->empresa_envio }}</td>
                <td>{{ $envio->numero_seguimiento }}</td>
                <td>{{ $envio->fecha_envio }}</td>
                <td>
                    <a href="{{ route('envio.edit', $envio->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('envio.destroy', $envio->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este envío?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
