<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use App\Models\Ingrediente;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RecetaController extends Controller
{
    public function create() {
        return view('recetas.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nombre_receta' => ['required', 'string', 'min:3', 'max:150'],
            'descripcion' => ['nullable', 'string'],
            'procedimiento' => ['nullable', 'string'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'ingredientes' => ['nullable', 'array'],
            'ingredientes.*.nombre' => ['nullable', 'string', 'max:100'],
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('recetas', 'public');
        }

        $receta = Receta::create([
            'nombre_receta' => $validated['nombre_receta'],
            'slug' => $this->makeUniqueSlug($validated['nombre_receta']),
            'porciones' => null,
            'id_usuario' => auth()->id(),
            'fecha_creacion' => now()->toDateString(),
            'descripcion' => $validated['descripcion'] ?? null,
            'procedimiento' => $validated['procedimiento'] ?? null,
            'imagen' => $rutaImagen,
        ]);

        if ($request->has('ingredientes')) {
            $this->syncIngredientes($receta, $request->ingredientes);
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

    public function edit(Receta $receta) {
        $receta->load('ingredientes');
        return view('recetas.edit', ['receta' => $receta]);
    }

    public function update(Request $request, Receta $receta) {
        $validated = $request->validate([
            'nombre_receta' => ['required', 'string', 'min:3', 'max:150'],
            'descripcion' => ['nullable', 'string'],
            'procedimiento' => ['nullable', 'string'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'ingredientes' => ['nullable', 'array'],
            'ingredientes.*.nombre' => ['nullable', 'string', 'max:100'],
        ]);

        $rutaImagen = $receta->imagen;
        if ($request->hasFile('imagen')) {
            if ($receta->imagen) {
                Storage::disk('public')->delete($receta->imagen);
            }
            $rutaImagen = $request->file('imagen')->store('recetas', 'public');
        }

        $receta->update([
            'nombre_receta' => $validated['nombre_receta'],
            'slug' => $this->makeUniqueSlug($validated['nombre_receta'], $receta->id_receta),
            'descripcion' => $validated['descripcion'] ?? null,
            'procedimiento' => $validated['procedimiento'] ?? null,
            'imagen' => $rutaImagen,
        ]);

        if ($request->has('ingredientes')) {
            $this->syncIngredientes($receta, $request->ingredientes);
        }

        return redirect()->route('recetas.show', $receta)->with('status', 'success-receta-update');
    }

    public function destroy(Receta $receta) {
        if ($receta->imagen) {
            Storage::disk('public')->delete($receta->imagen);
        }

        $receta->delete();

        return redirect()->route('recetas')->with('status', 'success-receta-delete');
    }

    private function makeUniqueSlug(string $nombre, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($nombre, '-');
        $slug = $baseSlug;
        $counter = 1;

        while ($this->slugExists($slug, $ignoreId)) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }

    private function slugExists(string $slug, ?int $ignoreId = null): bool
    {
        $query = Receta::where('slug', $slug);
        if ($ignoreId !== null) {
            $query->where('id_receta', '!=', $ignoreId);
        }

        return $query->exists();
    }

    private function syncIngredientes(Receta $receta, array $ingredientes): void
    {
        foreach ($ingredientes as $ing) {
            $nombre = trim($ing['nombre'] ?? '');
            if ($nombre === '') {
                continue;
            }

            $ingrediente = Ingrediente::firstOrCreate([
                'nombre' => $nombre,
            ]);

            $receta->ingredientes()->syncWithoutDetaching($ingrediente->id_ingrediente);
        }
    }
}
