<?php

namespace App\Http\Controllers;

use App\Models\VarianteImagen;
use Illuminate\Http\Request;

class VarianteImagenController extends Controller
{
    public function destroy(VarianteImagen $imagen)
    {
        if (\Storage::disk('public')->exists($imagen->imagen_url)) {
            \Storage::disk('public')->delete($imagen->imagen_url);
        }

        $imagen->delete();

        return back()->with('success', 'Imagen eliminada correctamente.');
    }
}
