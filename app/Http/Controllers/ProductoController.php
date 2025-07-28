<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\TipoProducto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria', 'tipo')->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $tipos = TipoProducto::all();
        return view('productos.create', compact('categorias', 'tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:150',
            'descripcion' => 'nullable',
            'categoria_id' => 'required|exists:categoria,id',
            'tipo_id' => 'required|exists:tipoproducto,id',
            'precio' => 'required|numeric|min:0',
            'costo' => 'required|numeric|min:0',
            'activo' => 'boolean'
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        $tipos = TipoProducto::all();
        return view('productos.edit', compact('producto', 'categorias', 'tipos'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'required|max:150',
            'descripcion' => 'nullable',
            'categoria_id' => 'required|exists:categoria,id',
            'tipo_id' => 'required|exists:tipoproducto,id',
            'precio' => 'required|numeric|min:0',
            'costo' => 'required|numeric|min:0',
            'activo' => 'boolean'
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        Producto::destroy($id);
        return redirect()->route('productos.index')->with('success', 'Producto eliminado.');
    }
}
