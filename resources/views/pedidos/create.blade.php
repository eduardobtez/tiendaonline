@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nuevo Pedido</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('pedidos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-select" required>
                <option value="">Seleccione un cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>

        <h5 class="mt-4">Productos</h5>
        <div id="productos-container">
            <div class="row mb-3 producto-row">
                <div class="col-md-6">
                    <select name="productos[0][variante_id]" class="form-select" required>
                        <option value="">Seleccione una variante</option>
                        @foreach($variantes as $variante)
                            <option value="{{ $variante->id }}">
                                {{ $variante->producto->nombre }} - Talle: {{ $variante->talle->nombre }} - Color: {{ $variante->color->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="productos[0][cantidad]" class="form-control" placeholder="Cantidad" min="1" required>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-secondary mb-3" onclick="agregarProducto()">Agregar Producto</button>

        <div>
            <button type="submit" class="btn btn-primary">Guardar Pedido</button>
            <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script>
    let productoIndex = 1;
    function agregarProducto() {
        const row = document.createElement('div');
        row.className = 'row mb-3 producto-row';

        row.innerHTML = `
            <div class="col-md-6">
                <select name="productos[${productoIndex}][variante_id]" class="form-select" required>
                    <option value="">Seleccione una variante</option>
                    @foreach($variantes as $variante)
                        <option value="{{ $variante->id }}">
                            {{ $variante->producto->nombre }} - Talle: {{ $variante->talle->nombre }} - Color: {{ $variante->color->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="productos[${productoIndex}][cantidad]" class="form-control" placeholder="Cantidad" min="1" required>
            </div>
        `;

        document.getElementById('productos-container').appendChild(row);
        productoIndex++;
    }
</script>
@endsection
