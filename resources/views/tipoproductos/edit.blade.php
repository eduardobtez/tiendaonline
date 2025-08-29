@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Tipo de Producto</h2>
    <form action="{{ route('tipoproductos.update', $tipo) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $tipo->nombre }}" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('tipoproductos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
