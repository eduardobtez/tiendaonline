@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pedidos</h1>
    <a href="{{ route('pedidos.create') }}" class="btn btn-primary mb-3">Nuevo Pedido</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($pedidos as $pedido)
            <tr>
                <td>{{ $pedido->id }}</td>
                <td>{{ $pedido->cliente->nombre }}</td>
                <td>{{ $pedido->fecha_pedido }}</td>
                <td>$ {{ number_format($pedido->total, 2) }}</td>
                <td>{{ $pedido->estado }}</td>
                <td>
                    <a href="{{ route('pedidos.show', $pedido) }}" class="btn btn-info btn-sm">Ver</a>
                    <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar pedido?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
