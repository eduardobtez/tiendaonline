@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2>Bienvenido, {{ auth()->user()->name }}</h2>
    <p>Estás autenticado correctamente.</p>
@endsection
