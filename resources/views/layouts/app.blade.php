<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistema')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-4">

        @auth
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                {{-- Admin y Editor --}}
                @if(in_array(auth()->user()->rol, ['admin', 'editor']))
                    <a class="navbar-brand" href="{{ route('dashboard') }}">Tienda</a>
                    <li class="nav-item"><a class="nav-link" href="{{ route('cliente.index') }}">Clientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('productos.index') }}">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pedidos.index') }}">Pedidos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('variantes.index') }}">Variantes</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pagos.index') }}">Pagos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('colores.index') }}">Colores</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('talles.index') }}">Talles</a></li>
                @endif

                {{-- Solo Admin --}}
                @if(auth()->user()->rol === 'admin')
                    <li class="nav-item"><a class="nav-link" href="{{ route('categorias.index') }}">Categorías</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('tipoproductos.index') }}">Tipos Prod.</a></li>
                @endif

                {{-- Solo Logística --}}
                @if(auth()->user()->rol === 'logistica')
                    <li class="nav-item"><a class="nav-link" href="{{ route('envio.index') }}">Envios</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('productos.index') }}">Productos</a></li>
                @endif
            </ul>

            <div class="ms-auto">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Cerrar sesión</button>
                </form>
            </div>
        </div>
        @endauth
    </nav>

    <div class="container py-4">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
