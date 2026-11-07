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
        'cantidad_porciones' => ['required', 'integer', 'min:1'],
        'tipo_porcion' => ['required', 'string', 'in:platillos,vasos,rebanadas,piezas,porciones'],
        'es_publica' => ['sometimes', 'boolean'],
        'descripcion' => ['nullable', 'string'],
        'procedimiento' => ['nullable', 'string'],
        'imagen' => ['nullable', 'image', 'max:2048'],
        'ingredientes' => ['required', 'array', 'min:1'],
        'ingredientes.*.nombre' => ['required', 'string', 'max:100'],
        'ingredientes.*.cantidad' => ['required', 'numeric', 'min:0.01'],
        'ingredientes.*.unidad_medida' => ['required', 'string', 'max:20'],
        'ingredientes.*.presentacion_cantidad' => ['required', 'numeric', 'min:0.01'],
        'ingredientes.*.presentacion_unidad' => ['required', 'string', 'max:20'],
        'ingredientes.*.costo_presentacion' => ['required', 'string', 'max:20'],

    ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('recetas', 'public');
        }
        
        $receta = Receta::create([
        'nombre_receta' => $request->input('nombre_receta'),
        'slug' => $this->makeUniqueSlug($request->input('nombre_receta')),
        'cantidad_porciones' => $validated['cantidad_porciones'],
        'tipo_porcion' => $validated['tipo_porcion'],
        'porciones' => null,
        'id_usuario' => auth()->id(),
        'fecha_creacion' => now()->toDateString(),
        'descripcion' => $request->input('descripcion'),
        'procedimiento' => $request->input('procedimiento'),
        'imagen' => $rutaImagen,
        'es_publica' => $validated['es_publica'] ?? false,
    ]);

        if ($request->has('ingredientes')) {
            $this->syncIngredientes($receta, $request->input('ingredientes', []));
        }

        return redirect()->route('recetas')->with('status', 'success-receta');
    }

    public function index() {
        $recetas = Receta::where('es_publica', true)->paginate(5);
        return View('recetas.receta', compact('recetas'));
    }

    public function show(Receta $receta) {
        abort_unless(
            $receta->es_publica || (auth()->check() && $receta->id_usuario === auth()->id()),
            404
        );
        $receta->load('ingredientes');
        return view('recetas.show', ['receta' => $receta]);
    }

    public function edit(Receta $receta) {
        if ($receta->id_usuario !== auth()->id()) {
            abort(403, 'No tienes permiso para editar esta receta.');
        }

        $receta->load('ingredientes');
        return view('recetas.edit', ['receta' => $receta]);
    }

    public function update(Request $request, Receta $receta) {
        if ($receta->id_usuario !== auth()->id()) {
            abort(403, 'No tienes permiso para editar esta receta.');
        }

        $validated = $request->validate([
        'nombre_receta' => ['required', 'string', 'min:3', 'max:150'],
        'descripcion' => ['nullable', 'string'],
        'procedimiento' => ['nullable', 'string'],
        'imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        'cantidad_porciones' => ['required', 'integer', 'min:1'],
        'tipo_porcion' => ['required', 'string', 'in:platillos,vasos,rebanadas,piezas,porciones'],
        'es_publica' => ['sometimes', 'boolean'],
        'ingredientes' => ['required', 'array', 'min:1'],
        'ingredientes.*.nombre' => ['required', 'string', 'max:100'],
        'ingredientes.*.cantidad' => ['required', 'numeric', 'min:0.01'],
        'ingredientes.*.unidad_medida' => ['required', 'string', 'max:20'],
        'ingredientes.*.presentacion_cantidad' => ['required', 'numeric', 'min:0.01'],
        'ingredientes.*.presentacion_unidad' => ['required', 'string', 'max:20'],
        'ingredientes.*.costo_presentacion' => ['required', 'string', 'max:20'],
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
            'cantidad_porciones' => $validated['cantidad_porciones'],
            'tipo_porcion' => $validated['tipo_porcion'],
            'descripcion' => $validated['descripcion'] ?? null,
            'procedimiento' => $validated['procedimiento'] ?? null,
            'imagen' => $rutaImagen,
            'es_publica' => $validated['es_publica'] ?? false,
        ]);

        $this->syncIngredientes($receta, $request->input('ingredientes', []));

        return redirect()->route('recetas.show', $receta)->with('status', 'success-receta-update');
    }

    public function destroy(Receta $receta) {
        if ($receta->id_usuario !== auth()->id()) {
            abort(403, 'No tienes permiso para eliminar esta receta.');
        }

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

   private function syncIngredientes(
            Receta $receta,
            array $ingredientes
        ): void
        {
            $syncData = [];

            foreach ($ingredientes as $ing) {

                $nombre = trim($ing['nombre'] ?? '');

                if ($nombre === '') {
                    continue;
                }


                $unidad = $ing['unidad_medida'] ?? null;
                $presentacionUnidad = $unidad;

                $ingrediente = Ingrediente::firstOrNew(['nombre' => $nombre]);

                if (!$ingrediente->exists) {
                    $ingrediente->fill([
                        'unidad_medida' => $unidad,
                        'presentacion_cantidad' => $ing['presentacion_cantidad'] ?? null,
                        'presentacion_unidad' => $presentacionUnidad,
                        'costo_presentacion' => $ing['costo_presentacion'] ?? null,
                    ]);
                    $ingrediente->save();
                }


                $syncData[$ingrediente->id_ingrediente] = [

                    'cantidad' =>
                        $ing['cantidad'] ?? 0,

                    'unidad_medida' =>
                        $unidad,

                    'merma_aplicada' =>
                        $ing['merma_aplicada'] ?? 0,
                ];
            }


            $receta->ingredientes()->sync($syncData);
        }
}
