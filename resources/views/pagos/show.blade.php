@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pago #{{ $pago->id }}</h1>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Pedido:</strong> #{{ $pago->pedido_id }} @if($pago->pedido) - {{ $pago->pedido->cliente->nombre ?? '' }} @endif</p>
            <p><strong>Método:</strong> {{ ucfirst($pago->metodo) }}</p>
            <p><strong>Estado:</strong> {{ ucfirst($pago->estado) }}</p>
            <p><strong>Monto:</strong> $ {{ number_format($pago->monto, 2) }}</p>
            <p><strong>Fecha:</strong> {{ $pago->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('pagos.index') }}" class="btn btn-secondary">Volver</a>
    <a href="{{ route('pagos.edit', $pago) }}" class="btn btn-warning">Editar</a>
</div>
@endsection
