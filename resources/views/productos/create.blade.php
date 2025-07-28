@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Producto</h1>
    <form action="{{ route('productos.store') }}" method="POST">
        @include('productos._form')
        <button class="btn btn-primary">Guardar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
