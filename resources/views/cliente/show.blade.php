@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Cliente</h1>

    <div class="mb-3"><strong>Nombre:</strong> {{ $cliente->nombre }}</div>
    <div class="mb-3"><strong>Email:</strong> {{ $cliente->email }}</div>
    <div class="mb-3"><strong>Teléfono:</strong> {{ $cliente->telefono }}</div>

    <a href="{{ route('cliente.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
