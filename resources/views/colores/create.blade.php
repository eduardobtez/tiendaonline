@extends('layouts.app')

@section('title', 'Nuevo Color')

@section('content')
<h1 class="h3 mb-3">Nuevo Color</h1>

<form action="{{ route('colores.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        @error('nombre') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="codigo_hex" class="form-label">Código Hex</label>
        <input type="text" name="codigo_hex" class="form-control" value="{{ old('codigo_hex') }}" placeholder="#FFFFFF">
        @error('codigo_hex') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="imagen_url" class="form-label">URL Imagen</label>
        <input type="url" name="imagen_url" class="form-control" value="{{ old('imagen_url') }}">
        @error('imagen_url') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <button class="btn btn-success">Guardar</button>
    <a href="{{ route('colores.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
