@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Nuevo Tipo de Producto</h2>
    <form action="{{ route('tipoproductos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('tipoproductos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
