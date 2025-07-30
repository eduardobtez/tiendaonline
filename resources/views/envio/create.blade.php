@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Envío</h1>

    <form action="{{ route('envio.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="pedido_id" class="form-label">Pedido</label>
            <select name="pedido_id" class="form-select" required>
                <option value="">Seleccione un pedido</option>
                @foreach($pedidos as $pedido)
                    <option value="{{ $pedido->id }}">#{{ $pedido->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado del envío</label>
            <input type="text" name="estado_envio" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Empresa de envío</label>
            <input type="text" name="empresa_envio" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Número de seguimiento</label>
            <input type="text" name="numero_seguimiento" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de envío</label>
            <input type="date" name="fecha_envio" class="form-control">
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('envio.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
