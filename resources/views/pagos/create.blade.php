@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Pago</h1>

    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul></div>
    @endif

    <form action="{{ route('pagos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Pedido</label>
            <select name="pedido_id" class="form-select" required>
                <option value="">Seleccione un pedido</option>
                @foreach($pedidos as $pedido)
                    <option value="{{ $pedido->id }}" @selected(old('pedido_id') == $pedido->id)>
                        #{{ $pedido->id }} — {{ $pedido->cliente->nombre ?? 'Sin cliente' }} — ${{ number_format($pedido->total,2) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Método</label>
                <select name="metodo" class="form-select" required>
                    <option value="">Seleccione</option>
                    @foreach($metodos as $m)
                        <option value="{{ $m }}" @selected(old('metodo') == $m)>{{ ucfirst($m) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-select" required>
                    <option value="">Seleccione</option>
                    @foreach($estados as $e)
                        <option value="{{ $e }}" @selected(old('estado') == $e)>{{ ucfirst($e) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Monto</label>
                <input type="number" step="0.01" name="monto" class="form-control" required value="{{ old('monto') }}">
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-success">Guardar</button>
            <a href="{{ route('pagos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
