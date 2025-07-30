@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Envío</h1>

    <form action="{{ route('envio.update', $envio->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Pedido</label>
            <select name="pedido_id" class="form-select" required>
                @foreach($pedidos as $pedido)
                    <option value="{{ $pedido->id }}" @selected($envio->pedido_id == $pedido->id)>#{{ $pedido->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado del envío</label>
            <input type="text" name="estado_envio" class="form-control" value="{{ $envio->estado_envio }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Empresa de envío</label>
            <input type="text" name="empresa_envio" class="form-control" value="{{ $envio->empresa_envio }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Número de seguimiento</label>
            <input type="text" name="numero_seguimiento" class="form-control" value="{{ $envio->numero_seguimiento }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de envío</label>
            <input type="date" name="fecha_envio" class="form-control" value="{{ $envio->fecha_envio }}">
        </div>

        <button class="btn btn-success">Actualizar</button>
        <a href="{{ route('envio.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
