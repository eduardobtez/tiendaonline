@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Pago #{{ $pago->id }}</h1>

    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul></div>
    @endif

    <form action="{{ route('pagos.update', $pago) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Pedido</label>
            <select name="pedido_id" class="form-select" required>
                @foreach($pedidos as $pedido)
                    <option value="{{ $pedido->id }}" @selected(old('pedido_id', $pago->pedido_id) == $pedido->id)>
                        #{{ $pedido->id }} — {{ $pedido->cliente->nombre ?? 'Sin cliente' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Método</label>
                <select name="metodo" class="form-select" required>
                    @foreach($metodos as $m)
                        <option value="{{ $m }}" @selected(old('metodo', $pago->metodo) == $m)>{{ ucfirst($m) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-select" required>
                    @foreach($estados as $e)
                        <option value="{{ $e }}" @selected(old('estado', $pago->estado) == $e)>{{ ucfirst($e) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Monto</label>
                <input type="number" step="0.01" name="monto" class="form-control" required value="{{ old('monto', $pago->monto) }}">
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-primary">Actualizar</button>
            <a href="{{ route('pagos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
