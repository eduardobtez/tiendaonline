<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistema')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
        <a class="navbar-brand" href="#">Tienda</a>
        <div class="ms-auto">
            @auth
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Cerrar sesión</button>
                </form>
            @endauth
        </div>
    </nav>

    <div class="container py-4">
        @yield('content')
    </div>
</body>
</html>
