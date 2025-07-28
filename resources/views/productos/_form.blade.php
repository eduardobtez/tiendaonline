@csrf
<div class="mb-3">
    <label>Nombre</label>
    <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label>Descripción</label>
    <textarea name="descripcion" class="form-control">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label>Categoría</label>
    <select name="categoria_id" class="form-select" required>
        <option value="">Seleccionar</option>
        @foreach($categorias as $categoria)
            <option value="{{ $categoria->id }}" @selected(old('categoria_id', $producto->categoria_id ?? '') == $categoria->id)>
                {{ $categoria->nombre }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label>Tipo de Producto</label>
    <select name="tipo_id" class="form-select" required>
        <option value="">Seleccionar</option>
        @foreach($tipos as $tipo)
            <option value="{{ $tipo->id }}" @selected(old('tipo_id', $producto->tipo_id ?? '') == $tipo->id)>
                {{ $tipo->nombre }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label>Precio</label>
    <input type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label>Costo</label>
    <input type="number" step="0.01" name="costo" value="{{ old('costo', $producto->costo ?? '') }}" class="form-control" required>
</div>
<div class="mb-3 form-check">
    <input type="checkbox" name="activo" value="1" class="form-check-input" id="activo"
        {{ old('activo', $producto->activo ?? true) ? 'checked' : '' }}>
    <label class="form-check-label" for="activo">Activo</label>
</div>
