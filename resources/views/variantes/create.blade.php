@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nueva Variante</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('variantes.store') }}" method="POST">
        @csrf

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Producto</label>
                <select name="producto_id" class="form-select" required>
                    <option value="">Seleccione...</option>
                    @foreach($productos as $p)
                        <option value="{{ $p->id }}" @selected(old('producto_id') == $p->id)>{{ $p->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Color</label>
                <select name="color_id" class="form-select" required>
                    <option value="">Seleccione...</option>
                    @foreach($colores as $c)
                        <option value="{{ $c->id }}" @selected(old('color_id') == $c->id)>{{ $c->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Talle</label>
                <select name="talle_id" class="form-select" required>
                    <option value="">Seleccione...</option>
                    @foreach($talles as $t)
                        <option value="{{ $t->id }}" @selected(old('talle_id') == $t->id)>{{ $t->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Código de barra</label>
                <input type="text" name="codigo_barra" class="form-control" value="{{ old('codigo_barra') }}" maxlength="50">
            </div>

            <div class="col-md-2">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" min="0" value="{{ old('stock', 0) }}" required>
            </div>

            <div class="col-md-2">
                <label class="form-label">Peso (kg)</label>
                <input type="number" step="0.01" name="peso" class="form-control" min="0" value="{{ old('peso') }}">
            </div>

            <div class="col-md-4">
                <label class="form-label">Imagen (URL)</label>
                <input type="url" name="imagen_url" class="form-control" value="{{ old('imagen_url') }}">
            </div>
        </div>

        <div class="mt-4">
            <button class="btn btn-primary">Guardar</button>
            <a href="{{ route('variantes.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
