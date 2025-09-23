<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colores = Color::orderBy('nombre')->paginate(15);
        return view('colores.index', compact('colores'));
    }

    public function create()
    {
        return view('colores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:100',
            'codigo_hex'  => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'imagen_url'  => 'nullable|url|max:2048',
        ]);

        Color::create($request->only(['nombre', 'codigo_hex', 'imagen_url']));

        return redirect()->route('colores.index')->with('success', 'Color creado correctamente.');
    }

    public function show(Color $colore) // Laravel pluraliza el recurso
    {
        return view('colores.show', ['color' => $colore]);
    }

    public function edit(Color $colore)
    {
        return view('colores.edit', ['color' => $colore]);
    }

    public function update(Request $request, Color $colore)
    {
        $request->validate([
            'nombre'      => 'required|string|max:100',
            'codigo_hex'  => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'imagen_url'  => 'nullable|url|max:2048',
        ]);

        $colore->update($request->only(['nombre', 'codigo_hex', 'imagen_url']));

        return redirect()->route('colores.index')->with('success', 'Color actualizado correctamente.');
    }

    public function destroy(Color $colore)
    {
        $colore->delete();
        return redirect()->route('colores.index')->with('success', 'Color eliminado correctamente.');
    }
}
