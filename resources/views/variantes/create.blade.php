@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nueva Variante</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('variantes.store') }}" method="POST" enctype="multipart/form-data">
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
                <label class="form-label">Peso (g)</label>
                <input type="number" step="0.01" name="peso" class="form-control" min="0" value="{{ old('peso') }}">
            </div>

            <!-- NUEVO: Subir imágenes desde PC -->
            <div class="col-md-4">
                <label class="form-label">Imágenes (puede seleccionar varias)</label>
                <input type="file" name="imagenes[]" class="form-control" multiple accept="image/*" id="imagenesInput">
            </div>

            <!-- Previsualización de imágenes -->
            <div class="col-12 mt-2" id="previewContainer" style="display:flex; gap:10px; flex-wrap: wrap;"></div>

        </div>

        <div class="mt-4">
            <button class="btn btn-primary">Guardar</button>
            <a href="{{ route('variantes.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<!-- Script para previsualizar imágenes -->
<script>
    document.getElementById('imagenesInput').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('previewContainer');
        previewContainer.innerHTML = ''; // Limpiar previews anteriores

        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.height = '100px';
                img.style.objectFit = 'contain';
                img.classList.add('border', 'p-1');
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endsection
