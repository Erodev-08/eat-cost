<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use App\Models\Ingrediente;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RecetaController extends Controller
{
    public function store(Request $request) {

        // Guarda Imagen
        $rutaImagen = null;

        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('recetas', 'public');
        }

        // Crear receta
        $receta = Receta::create([
            'nombre_receta' => $request->nombre_receta,
            'slug' => Str::slug($request->nombre_receta, '-'),
            'porciones' => null,
            'id_usuario' => auth()->id(),
            'fecha_creacion' => now(),
            'descripcion' => $request->descripcion,
            'procedimiento' => $request->procedimiento,
            'imagen' => $rutaImagen
        ]);

        // Guardar ingredientes
        if ($request->has('ingredientes')) {
            foreach ($request->ingredientes as $ing) {

                if (!empty($ing['nombre'])) {
                // Crear o encontrar ingrediente
                    $ingrediente = Ingrediente::firstOrCreate([
                        'nombre' => $ing['nombre']
                    ]);
                
                    $receta->ingredientes()->syncWithoutDetaching($ingrediente->id_ingrediente);
                }
            }
        }

        return redirect()->route('recetas')->with('status', 'success-receta');

    }
    public function index() {
        $recetas = Receta::paginate(5);
        return View('recetas.receta', compact('recetas'));
    }
    public function show(Receta $receta) {
        $receta->load('ingredientes');
        return view('recetas.show', ['receta' => $receta]);
    }
}
