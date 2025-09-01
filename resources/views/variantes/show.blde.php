@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Variante #{{ $variante->id }}</h1>

    <div class="card bg-dark text-light mb-3">
        <div class="card-body">
            <p><strong>Producto:</strong> {{ $variante->producto->nombre ?? '-' }}</p>
            <p><strong>Color:</strong> {{ $variante->color->nombre ?? '-' }}</p>
            <p><strong>Talle:</strong> {{ $variante->talle->nombre ?? '-' }}</p>
            <p><strong>Código de barra:</strong> {{ $variante->codigo_barra ?? '-' }}</p>
            <p><strong>Stock:</strong> {{ $variante->stock }}</p>
            <p><strong>Peso (kg):</strong> {{ $variante->peso ?? '-' }}</p>
            <p><strong>Imagen:</strong>
                @if($variante->imagen_url)
                    <br><img src="{{ $variante->imagen_url }}" alt="imagen variante" style="height:120px;width:auto;">
                @else
                    -
                @endif
            </p>
            <p><strong>Creado:</strong> {{ $variante->created_at }}</p>
            <p><strong>Actualizado:</strong> {{ $variante->updated_at }}</p>
        </div>
    </div>

    <a href="{{ route('variantes.index') }}" class="btn btn-secondary">Volver</a>
    <a href="{{ route('variantes.edit', $variante) }}" class="btn btn-warning">Editar</a>
</div>
@endsection
