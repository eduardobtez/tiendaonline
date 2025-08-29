@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Pagos</h1>

    <a href="{{ route('pagos.create') }}" class="btn btn-primary mb-3">Registrar Pago</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-dark align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pedido</th>
                    <th>Método</th>
                    <th>Estado</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pagos as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>#{{ $p->pedido_id }} @if($p->pedido) - {{ $p->pedido->cliente->nombre ?? '' }} @endif</td>
                    <td>{{ $p->metodo }}</td>
                    <td>{{ $p->estado }}</td>
                    <td>$ {{ number_format($p->monto, 2) }}</td>
                    <td>{{ $p->created_at->format('d/m/Y H:i') }}</td>
                    <td class="text-end">
                        <a href="{{ route('pagos.show', $p) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('pagos.edit', $p) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('pagos.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este pago?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7">No hay pagos registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $pagos->links() }}
</div>
@endsection
