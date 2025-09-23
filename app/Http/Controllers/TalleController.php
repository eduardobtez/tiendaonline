<?php

namespace App\Http\Controllers;

use App\Models\Talle;
use Illuminate\Http\Request;

class TalleController extends Controller
{
    public function index()
    {
        $talles = Talle::orderBy('nombre')->paginate(15);
        return view('talles.index', compact('talles'));
    }

    public function create()
    {
        return view('talles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:talle,nombre',
        ]);

        Talle::create($request->only(['nombre']));

        return redirect()->route('talles.index')->with('success', 'Talle creado correctamente.');
    }

    public function show(Talle $talle)
    {
        return view('talles.show', compact('talle'));
    }

    public function edit(Talle $talle)
    {
        return view('talles.edit', compact('talle'));
    }

    public function update(Request $request, Talle $talle)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:talle,nombre,' . $talle->id,
        ]);

        $talle->update($request->only(['nombre']));

        return redirect()->route('talles.index')->with('success', 'Talle actualizado correctamente.');
    }

    public function destroy(Talle $talle)
    {
        $talle->delete();
        return redirect()->route('talles.index')->with('success', 'Talle eliminado correctamente.');
    }
}
