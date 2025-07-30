<?php

namespace App\Http\Controllers;

use App\Models\Envio;
use App\Models\Pedido;
use Illuminate\Http\Request;

class EnvioController extends Controller
{
    public function index()
    {
        $envios = Envio::with('pedido')->orderBy('created_at', 'desc')->get();
        return view('envio.index', compact('envios'));
    }

    public function create()
    {
        $pedidos = Pedido::all();
        return view('envio.create', compact('pedidos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pedido_id' => 'required|exists:pedido,id',
            'estado_envio' => 'required|string|max:100',
            'empresa_envio' => 'nullable|string|max:100',
            'numero_seguimiento' => 'nullable|string|max:100',
            'fecha_envio' => 'nullable|date',
        ]);

        Envio::create($request->all());

        return redirect()->route('envio.index')->with('success', 'Envío registrado correctamente.');
    }

    public function edit($id)
    {
        $envio = Envio::findOrFail($id);
        $pedidos = Pedido::all();
        return view('envio.edit', compact('envio', 'pedidos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pedido_id' => 'required|exists:pedido,id',
            'estado_envio' => 'required|string|max:100',
            'empresa_envio' => 'nullable|string|max:100',
            'numero_seguimiento' => 'nullable|string|max:100',
            'fecha_envio' => 'nullable|date',
        ]);

        $envio = Envio::findOrFail($id);
        $envio->update($request->all());

        return redirect()->route('envio.index')->with('success', 'Envío actualizado correctamente.');
    }

    public function destroy($id)
    {
        $envio = Envio::findOrFail($id);
        $envio->delete();

        return redirect()->route('envio.index')->with('success', 'Envío eliminado correctamente.');
    }
}
