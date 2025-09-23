@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Variante #{{ $variante->id }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('variantes.update', $variante->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Producto</label>
                <select name="producto_id" class="form-select" required>
                    <option value="">Seleccione...</option>
                    @foreach($productos as $p)
                        <option value="{{ $p->id }}" @selected(old('producto_id', $variante->producto_id) == $p->id)>{{ $p->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Color</label>
                <select name="color_id" class="form-select" required>
                    <option value="">Seleccione...</option>
                    @foreach($colores as $c)
                        <option value="{{ $c->id }}" @selected(old('color_id', $variante->color_id) == $c->id)>{{ $c->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Talle</label>
                <select name="talle_id" class="form-select" required>
                    <option value="">Seleccione...</option>
                    @foreach($talles as $t)
                        <option value="{{ $t->id }}" @selected(old('talle_id', $variante->talle_id) == $t->id)>{{ $t->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Código de barra</label>
                <input type="text" name="codigo_barra" class="form-control" value="{{ old('codigo_barra', $variante->codigo_barra) }}" maxlength="50">
            </div>

            <div class="col-md-2">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" min="0" value="{{ old('stock', $variante->stock) }}" required>
            </div>

            <div class="col-md-2">
                <label class="form-label">Peso (kg)</label>
                <input type="number" step="0.01" name="peso" class="form-control" min="0" value="{{ old('peso', $variante->peso) }}">
            </div>
        </div>

        {{-- Imágenes existentes --}}
        <div class="mb-3">
            <label class="form-label">Imágenes existentes</label>
            <div class="d-flex flex-wrap gap-2 mb-2">
                @forelse($variante->imagenes as $img)
                    <div class="position-relative">
                        <img src="{{ asset('storage/'.$img->imagen_url) }}" class="img-thumbnail" style="max-height:120px;">
                        <form action="{{ route('variantes.imagen.destroy', $img->id) }}" method="POST" class="position-absolute top-0 end-0">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Eliminar imagen?')">&times;</button>
                        </form>
                    </div>
                @empty
                    <p>- No hay imágenes cargadas -</p>
                @endforelse
            </div>
        </div>

        {{-- Subir nuevas imágenes --}}
        <div class="mb-3">
            <label class="form-label">Subir nuevas imágenes</label>
            <input type="file" name="imagenes[]" class="form-control" multiple accept="image/*">
            <small class="text-muted">Se permiten jpg, jpeg, png, webp. Tamaño máximo 2MB por imagen.</small>
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('variantes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
