<?php

namespace App\Http\Controllers;

use App\Models\Variante;
use App\Models\Producto;
use App\Models\Color;
use App\Models\Talle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VarianteController extends Controller
{
    public function index()
    {
        $variantes = Variante::with(['producto', 'color', 'talle', 'imagenes'])
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
            'imagenes.*'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $variante = Variante::create($request->only([
            'producto_id','color_id','talle_id','codigo_barra','stock','peso'
        ]));

        // Si se suben imágenes, guardarlas y si no hay imagen principal, asignar la primera
        if ($request->hasFile('imagenes')) {
            $firstPath = null;
            foreach ($request->file('imagenes') as $img) {
                $path = $img->store('variantes', 'public'); // storage/app/public/variantes/...
                $variante->imagenes()->create(['imagen_url' => $path]);
                if (!$firstPath) {
                    $firstPath = $path;
                }
            }

            if ($firstPath && !$variante->imagen_url) {
                $variante->imagen_url = $firstPath;
                $variante->save();
            }
        }

        return redirect()->route('variantes.index')->with('success', 'Variante creada correctamente.');
    }

    public function show(Variante $variante)
    {
        $variante->load(['producto', 'color', 'talle', 'imagenes']);
        return view('variantes.show', compact('variante'));
    }

    public function edit(Variante $variante)
    {
        $productos = Producto::orderBy('nombre')->get();
        $colores   = Color::orderBy('nombre')->get();
        $talles    = Talle::orderBy('nombre')->get();

        $variante->load('imagenes');

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
            'imagenes.*'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $variante->update($request->only([
            'producto_id','color_id','talle_id','codigo_barra','stock','peso'
        ]));

        if ($request->hasFile('imagenes')) {
            $firstPath = null;
            foreach ($request->file('imagenes') as $img) {
                $path = $img->store('variantes', 'public');
                $variante->imagenes()->create(['imagen_url' => $path]);
                if (!$firstPath) {
                    $firstPath = $path;
                }
            }

            // Si no existía imagen principal, setear la primera subida como principal
            if ($firstPath && !$variante->imagen_url) {
                $variante->imagen_url = $firstPath;
                $variante->save();
            }
        }

        // recargar relación para la vista
        $variante->load('imagenes');

        return redirect()->route('variantes.edit', $variante)->with('success', 'Variante actualizada correctamente.');
    }

    public function destroy(Variante $variante)
    {
        // Eliminar imágenes del storage
        foreach ($variante->imagenes as $img) {
            if (Storage::disk('public')->exists($img->imagen_url)) {
                Storage::disk('public')->delete($img->imagen_url);
            }
        }

        // Eliminar archivo de imagen principal si apunta a algo distinto
        if ($variante->imagen_url && Storage::disk('public')->exists($variante->imagen_url)) {
            Storage::disk('public')->delete($variante->imagen_url);
        }

        // Eliminar registros en la tabla variante_imagen (siempre que haya FK con cascade podría no ser necesario)
        $variante->imagenes()->delete();

        $variante->delete();

        return redirect()->route('variantes.index')->with('success', 'Variante eliminada correctamente.');
    }
}
