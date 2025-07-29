<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Cliente;
use App\Models\Variante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function index()
    {
       $pedidos = Pedido::with('cliente')->orderBy('created_at', 'desc')->get();
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $variantes = Variante::with(['producto', 'color', 'talle'])->get();
        return view('pedidos.create', compact('clientes', 'variantes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:cliente,id',
            'productos' => 'required|array|min:1',
            'productos.*.variante_id' => 'required|exists:variante,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $pedido = Pedido::create([
                'cliente_id' => $request->cliente_id,
                'fecha_pedido' => now(),
                'total' => 0,
                'estado' => 'pendiente'
            ]);

            $total = 0;

            foreach ($request->productos as $item) {
                $variante = Variante::findOrFail($item['variante_id']);

                if ($variante->stock < $item['cantidad']) {
                    throw new \Exception("Stock insuficiente para la variante ID: {$variante->id}");
                }

                $precio = $variante->precio;
                DetallePedido::create([
                    'pedido_id' => $pedido->id,
                    'variante_id' => $variante->id,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $precio
                ]);

                $total += $precio * $item['cantidad'];

                $variante->stock -= $item['cantidad'];
                $variante->save();
            }

            $pedido->total = $total;
            $pedido->save();

            DB::commit();

            return redirect()->route('pedidos.index')->with('success', 'Pedido registrado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Error: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Pedido $pedido)
    {
        $pedido->load('cliente', 'detalles.variante.producto', 'detalles.variante.color', 'detalles.variante.talle');
        return view('pedidos.show', compact('pedido'));
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedidos.index')->with('success', 'Pedido eliminado.');
    }
}
