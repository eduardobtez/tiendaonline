@extends('layouts.app')

@section('title', 'Detalle Talle')

@section('content')
<h1 class="h3 mb-3">Detalle Talle</h1>

<div class="card">
    <div class="card-body">
        <p><strong>Nombre:</strong> {{ $talle->nombre }}</p>
    </div>
</div>

<a href="{{ route('talles.index') }}" class="btn btn-secondary mt-3">Volver</a>
@endsection
