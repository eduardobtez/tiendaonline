@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100" style="background-color: #f5f6fa;">
    <div class="card p-4 shadow-sm" style="width: 100%; max-width: 400px; border-radius: 15px;">
        <h3 class="text-center mb-4" style="font-weight: 500;">Iniciar sesión</h3>

        @if ($errors->any())
            <div class="alert alert-danger small">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label small text-muted">Correo electrónico</label>
                <input type="email" name="email" id="email" 
                       class="form-control form-control-lg" 
                       placeholder="ejemplo@correo.com" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label small text-muted">Contraseña</label>
                <input type="password" name="password" id="password" 
                       class="form-control form-control-lg" 
                       placeholder="********" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg" style="border-radius: 10px;">Ingresar</button>
            </div>
        </form>

        <p class="text-center text-muted mt-3 mb-0 small">© {{ date('Y') }} Tienda</p>
    </div>
</div>
@endsection
