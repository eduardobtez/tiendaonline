<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PagoController extends Controller
{
    /**
     * Mostrar listado de pagos
     */
    public function index()
    {
        $pagos = Pago::with('pedido')->orderBy('created_at', 'desc')->paginate(20);
        return view('pagos.index', compact('pagos'));
    }

    /**
     * Formulario de creación
     */
    public function create()
    {
        $pedidos = Pedido::orderByDesc('created_at')->get();
        $metodos = Pago::metodosValidos();
        $estados = Pago::estadosValidos();

        return view('pagos.create', compact('pedidos', 'metodos', 'estados'));
    }

    /**
     * Almacenar nuevo pago
     */
    public function store(Request $request)
    {
        $request->validate([
            'pedido_id' => ['required', 'exists:pedido,id'],
            'metodo'    => ['required', Rule::in(Pago::metodosValidos())],
            'estado'    => ['required', Rule::in(Pago::estadosValidos())],
            'monto'     => ['required', 'numeric', 'min:0'],
        ]);

        // Crear pago
        $pago = Pago::create($request->only(['pedido_id', 'metodo', 'estado', 'monto']));

        // Opcional: si el pago se marca como 'pagado', actualizar estado del pedido
        if ($pago->estado === 'pagado') {
            $pedido = $pago->pedido;
            if ($pedido) {
                $pedido->estado = 'pagado';
                $pedido->save();
            }
        }

        return redirect()->route('pagos.index')->with('success', 'Pago registrado correctamente.');
    }

    /**
     * Mostrar detalle de un pago
     */
    public function show(Pago $pago)
    {
        $pago->load('pedido');
        return view('pagos.show', compact('pago'));
    }

    /**
     * Formulario edición
     */
    public function edit(Pago $pago)
    {
        $pedidos = Pedido::orderByDesc('created_at')->get();
        $metodos = Pago::metodosValidos();
        $estados = Pago::estadosValidos();

        return view('pagos.edit', compact('pago', 'pedidos', 'metodos', 'estados'));
    }

    /**
     * Actualizar pago
     */
    public function update(Request $request, Pago $pago)
    {
        $request->validate([
            'pedido_id' => ['required', 'exists:pedido,id'],
            'metodo'    => ['required', Rule::in(Pago::metodosValidos())],
            'estado'    => ['required', Rule::in(Pago::estadosValidos())],
            'monto'     => ['required', 'numeric', 'min:0'],
        ]);

        $pago->update($request->only(['pedido_id', 'metodo', 'estado', 'monto']));

        // Opcional: sincronizar estado del pedido si pago pasó a 'pagado'
        if ($pago->estado === 'pagado' && $pago->pedido) {
            $pago->pedido->estado = 'pagado';
            $pago->pedido->save();
        }

        return redirect()->route('pagos.index')->with('success', 'Pago actualizado correctamente.');
    }

    /**
     * Eliminar pago
     */
    public function destroy(Pago $pago)
    {
        $pago->delete();
        return redirect()->route('pagos.index')->with('success', 'Pago eliminado.');
    }
}
