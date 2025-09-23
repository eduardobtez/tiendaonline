@extends('layouts.app')

@section('title', 'Editar Talle')

@section('content')
<h1 class="h3 mb-3">Editar Talle</h1>

<form action="{{ route('talles.update', $talle) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $talle->nombre) }}" required>
        @error('nombre') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <button class="btn btn-warning">Actualizar</button>
    <a href="{{ route('talles.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
