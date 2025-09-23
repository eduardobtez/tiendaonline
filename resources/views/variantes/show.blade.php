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
            
            <p><strong>Imágenes:</strong></p>
            @php
                $totalImagenes = ($variante->imagen_url ? 1 : 0) + $variante->imagenes->count();
            @endphp
            @if($totalImagenes > 0)
                <div id="carouselVariante{{ $variante->id }}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php $active = 'active'; @endphp

                        @if($variante->imagen_url)
                        <div class="carousel-item {{ $active }}">
                            <img src="{{ asset('storage/'.$variante->imagen_url) }}" class="d-block w-100" style="max-height:300px; object-fit:contain;" alt="Imagen principal">
                        </div>
                        @php $active = ''; @endphp
                        @endif

                        @foreach($variante->imagenes as $img)
                        <div class="carousel-item {{ $active }}">
                            <img src="{{ asset('storage/'.$img->imagen_url) }}" class="d-block w-100" style="max-height:300px; object-fit:contain;" alt="Imagen adicional">
                        </div>
                        @php $active = ''; @endphp
                        @endforeach
                    </div>

                    @if($totalImagenes > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselVariante{{ $variante->id }}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselVariante{{ $variante->id }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                    @endif
                </div>
            @else
                -
            @endif

            <p><strong>Creado:</strong> {{ $variante->created_at }}</p>
            <p><strong>Actualizado:</strong> {{ $variante->updated_at }}</p>
        </div>
    </div>

    <a href="{{ route('variantes.index') }}" class="btn btn-secondary">Volver</a>
    <a href="{{ route('variantes.edit', $variante) }}" class="btn btn-warning">Editar</a>
</div>
@endsection
