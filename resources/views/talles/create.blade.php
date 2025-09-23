@extends('layouts.app')

@section('title', 'Nuevo Talle')

@section('content')
<h1 class="h3 mb-3">Nuevo Talle</h1>

<form action="{{ route('talles.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        @error('nombre') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <button class="btn btn-success">Guardar</button>
    <a href="{{ route('talles.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
