<?php

namespace App\Http\Controllers;

use App\Models\VarianteImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VarianteImagenController extends Controller
{
    public function destroy(VarianteImagen $imagen)
    {
        // Cargar la variante asociada
        $variante = $imagen->variante;

        // Eliminar archivo físico si existe
        if (Storage::disk('public')->exists($imagen->imagen_url)) {
            Storage::disk('public')->delete($imagen->imagen_url);
        }

        // Guardar la ruta de la imagen que vamos a borrar (antes de borrar registro)
        $borradaRuta = $imagen->imagen_url;

        // Borrar registro
        $imagen->delete();

        // Si esa ruta era la imagen principal del variante, reasignar la principal
        if ($variante->imagen_url === $borradaRuta) {
            $proxima = $variante->imagenes()->orderBy('id')->first(); // siguiente imagen disponible
            if ($proxima) {
                $variante->imagen_url = $proxima->imagen_url;
            } else {
                $variante->imagen_url = null;
            }
            $variante->save();
        }

        return back()->with('success', 'Imagen eliminada correctamente.');
    }
}
