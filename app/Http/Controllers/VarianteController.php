<?php

namespace App\Http\Controllers;

use App\Models\Variante;
use App\Models\Producto;
use App\Models\Color;
use App\Models\Talle;
use Illuminate\Http\Request;

class VarianteController extends Controller
{
    public function index()
    {
        $variantes = Variante::with(['producto', 'color', 'talle'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('variantes.index', compact('variantes'));
    }

    public function create()
    {
        $productos = Producto::orderBy('nombre')->get();
        $colores   = Color::orderBy('nombre')->get();
        $talles    = Talle::orderBy('nombre')->get();

        return view('variantes.create', compact('productos', 'colores', 'talles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id'  => 'required|exists:producto,id',
            'color_id'     => 'required|exists:color,id',
            'talle_id'     => 'required|exists:talle,id',
            'codigo_barra' => 'nullable|string|max:50',
            'stock'        => 'required|integer|min:0',
            'peso'         => 'nullable|numeric|min:0',
            'imagen_url'   => 'nullable|url|max:2048',
        ]);

        Variante::create($request->only([
            'producto_id','color_id','talle_id','codigo_barra','stock','peso','imagen_url'
        ]));

        return redirect()->route('variantes.index')->with('success', 'Variante creada correctamente.');
    }

    public function show(Variante $variante)
    {
        $variante->load(['producto', 'color', 'talle']);
        return view('variantes.show', compact('variante'));
    }

    public function edit(Variante $variante)
    {
        $productos = Producto::orderBy('nombre')->get();
        $colores   = Color::orderBy('nombre')->get();
        $talles    = Talle::orderBy('nombre')->get();

        return view('variantes.edit', compact('variante', 'productos', 'colores', 'talles'));
    }

    public function update(Request $request, Variante $variante)
    {
        $request->validate([
            'producto_id'  => 'required|exists:producto,id',
            'color_id'     => 'required|exists:color,id',
            'talle_id'     => 'required|exists:talle,id',
            'codigo_barra' => 'nullable|string|max:50',
            'stock'        => 'required|integer|min:0',
            'peso'         => 'nullable|numeric|min:0',
            'imagen_url'   => 'nullable|url|max:2048',
        ]);

        $variante->update($request->only([
            'producto_id','color_id','talle_id','codigo_barra','stock','peso','imagen_url'
        ]));

        return redirect()->route('variantes.index')->with('success', 'Variante actualizada correctamente.');
    }

    public function destroy(Variante $variante)
    {
        $variante->delete();
        return redirect()->route('variantes.index')->with('success', 'Variante eliminada correctamente.');
    }
}
