@extends('layouts.app')

@section('title', 'Detalle Color')

@section('content')
<h1 class="h3 mb-3">Detalle Color</h1>

<div class="card">
    <div class="card-body">
        <p><strong>Nombre:</strong> {{ $color->nombre }}</p>
        <p><strong>Código Hex:</strong> {{ $color->codigo_hex }}</p>
        <p><strong>Imagen:</strong><br>
            @if($color->imagen_url)
                <img src="{{ $color->imagen_url }}" alt="Imagen" style="max-width:150px;">
            @else
                No disponible
            @endif
        </p>
    </div>
</div>

<a href="{{ route('colores.index') }}" class="btn btn-secondary mt-3">Volver</a>
@endsection
