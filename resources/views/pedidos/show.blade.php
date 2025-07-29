@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Pedido #{{ $pedido->id }}</h1>

    <p><strong>Cliente:</strong> {{ $pedido->cliente->nombre }}</p>
    <p><strong>Fecha:</strong> {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
    <p><strong>Total:</strong> $ {{ number_format($pedido->total, 2) }}</p>
    <p><strong>Estado:</strong> {{ $pedido->estado }}</p>

    <h5 class="mt-4">Productos</h5>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Talle</th>
                <th>Color</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedido->detalles as $detalle)
            <tr>
                <td>{{ $detalle->variante->producto->nombre }}</td>
                <td>{{ $detalle->variante->talle->nombre }}</td>
                <td>{{ $detalle->variante->color->nombre }}</td>
                <td>{{ $detalle->cantidad }}</td>
                <td>$ {{ number_format($detalle->precio_unitario, 2) }}</td>
                <td>$ {{ number_format($detalle->precio_unitario * $detalle->cantidad, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
