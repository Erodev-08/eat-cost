<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
use App\Models\Receta;
use App\Models\RecetaCalc;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function user(): View
    {
        $user = Auth::user();
        $profile = $user->profile;
        $recetasCount = \App\Models\Receta::where('id_usuario', $user->id_usuario)->count();
        $calculosCount = \App\Models\RecetaCalc::whereHas('receta', function ($query) use ($user) {
            $query->where('id_usuario', $user->id_usuario);
        })->count();
        
        return view('profile.user', compact('user', 'profile', 'recetasCount', 'calculosCount'));
    }
    
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'profile' => $request->user()->profile,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        // VALIDACIÓN
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => [
                'required',
                'email',
                \Illuminate\Validation\Rule::unique('users', 'email')
                    ->ignore($user->id_usuario, 'id_usuario')
            ],
            'institution' => 'nullable|string|max:150',
            'profile_image' => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:5120',
        ]);

        // ACTUALIZAR USUARIO
        $user->update([
            'nombre' => $request->name,
            'email' => $request->email,
            'email_verified_at' => $request->email === $user->email ? $user->email_verified_at : null,
            'institution' => $request->institution ?? $user->institution,
        ]);

        // OBTENER O CREAR PROFILE
        $profile = Profile::firstOrCreate([
            'id_user' => $user->id_usuario
        ]);

        // 📸 IMAGEN DE PERFIL
        if ($request->hasFile('profile_image')) {

            // eliminar anterior
            if ($profile->profile) {
                Storage::disk('public')->delete($profile->profile);
            }

            $path = $request->file('profile_image')->store('profiles', 'public');

            $profile->profile = $path;
        }

        // 🖼 IMAGEN DE PORTADA
        if ($request->hasFile('cover_image')) {

            if ($profile->cover_image) {
                Storage::disk('public')->delete($profile->cover_image);
            }

            $path = $request->file('cover_image')->store('covers', 'public');

            $profile->cover_image = $path;
        }

        $profile->save();

        return Redirect::route('profile')->with('status', 'profile-updated');
    }

    /**
     * Delete user's profile image.
     */
    public function deleteProfileImage(Request $request): RedirectResponse
    {
        $user = $request->user();
        $profile = $user->profile;

        if ($profile && $profile->profile) {
            // Eliminar archivo del storage
            if (Storage::disk('public')->exists($profile->profile)) {
                Storage::disk('public')->delete($profile->profile);
            }
            
            $profile->profile = null;
            $profile->save();
        }

        return Redirect::route('profile.user')->with('status', 'image-deleted');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        if ($user->profile && $user->profile->profile) {
            Storage::disk('public')->delete($user->profile->profile);
        }
        
        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updateCover(Request $request)
    {
        $request->validate([
            'cover_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120'
        ]);
        $user = auth()->user();
        $profile = $user->profile;
        if (!$profile) {
            $profile = new Profile();
            $profile->id_user = $user->id_usuario;
        }
        if ($request->hasFile('cover_image')) {
            if ($profile->cover_image && Storage::disk('public')->exists($profile->cover_image)) {
                Storage::disk('public')->delete($profile->cover_image);
            }
            $path = $request->file('cover_image')->store('covers', 'public');
            $profile->cover_image = $path;
        }
        $profile->save();
        return back()->with('status', 'cover-updated');
    }

    public function deleteCover(Request $request): RedirectResponse
    {
        $user = $request->user();
        $profile = $user->profile;

        if ($profile && $profile->cover_image) {
            // Eliminar archivo del storage
            if (Storage::disk('public')->exists($profile->cover_image)) {
                Storage::disk('public')->delete($profile->cover_image);
            }
        
            // Eliminar referencia en la base de datos
            $profile->cover_image = null;
            $profile->save();
        
            return Redirect::route('profile.user')->with('status', 'cover-deleted');
        }

        return Redirect::route('profile.user')->with('error', 'No se encontró imagen de portada para eliminar');
    }

    public function config(Request $request): View
    {
        return view('profile.configuracion', [
            'user' => $request->user(),
            'profile' => $request->user()->profile,
        ]);
    }

    public function recetaview(): View
    {
        $user = Auth::user();
        $recetas = Receta::where('id_usuario', $user->id_usuario)->paginate(5);
        return view('profile.recetas', compact('recetas', 'user'));
    }

    public function recetaselaboradasview()
    {
        // $recetasElaboradas = RecetaCalc::with('receta')
        //     ->latest('id_receta_elaborada')
        //     ->paginate(5);
        $user = Auth::user();
        $recetasElaboradas = RecetaCalc::where('id_usuario', $user->id_usuario)->paginate(5);

        return view('profile.mis-recetas-elaboradas', compact('recetasElaboradas', 'user'));
    }

    public function recetaviewCreate()
    {
        return view('profile.recetas.create');
    }

    public function recetaviewStore(Request $request)
    {
        $validated = $request->validate([
            'nombre_receta'                         => ['required', 'string', 'min:3', 'max:150'],
            'cantidad_porciones'                    => ['required', 'integer', 'min:1'],
            'tipo_porcion'                          => ['required', 'string'],
            'descripcion'                           => ['nullable', 'string'],
            'procedimiento'                         => ['nullable', 'string'],
            'imagen'                                => ['nullable', 'image', 'max:2048'],
            'ingredientes'                          => ['required', 'array'],
            'ingredientes.*.nombre'                 => ['required', 'string', 'max:100'],
            'ingredientes.*.cantidad'               => ['required', 'numeric', 'min:0.01'],
            'ingredientes.*.unidad_medida'          => ['required', 'string', 'max:20'],
            'ingredientes.*.presentacion_cantidad'  => ['required', 'numeric', 'min:0.01'],
            'ingredientes.*.presentacion_unidad'    => ['nullable', 'string', 'max:20'],
            'ingredientes.*.costo_presentacion'     => ['required', 'string', 'max:20'],
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
        ]);

        if ($request->has('ingredientes')) {
            $this->syncIngredientes($receta, $request->input('ingredientes', []));
        }

        return redirect()->route('profile.recetas')->with('status', 'success-receta');

    }

    public function recetaviewUpdate(Request $request, Receta $receta)
    {
        $validated = $request->validate([
            'nombre_receta'                         => ['required', 'string', 'min:3', 'max:150'],
            'descripcion'                           => ['nullable', 'string'],
            'procedimiento'                         => ['nullable', 'string'],
            'imagen'                                => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'cantidad_porciones'                    => ['required', 'integer', 'min:1'],
            'tipo_porcion'                          => ['required', 'string'],
            'ingredientes'                          => ['required', 'array'],
            'ingredientes.*.nombre'                 => ['required', 'string', 'max:100'],
            'ingredientes.*.cantidad'               => ['required', 'numeric', 'min:0.01'],
            'ingredientes.*.unidad_medida'          => ['required', 'string', 'max:20'],
            'ingredientes.*.presentacion_cantidad'  => ['required', 'numeric', 'min:0.01'],
            'ingredientes.*.presentacion_unidad'    => ['nullable', 'string', 'max:20'],
            'ingredientes.*.costo_presentacion'     => ['required', 'string', 'max:20'],
        ]);

        $rutaImagen = $receta->imagen;

        if ($request->hasFile('imagen')) {
            if ($receta->imagen) {
                Storage::disk('public')->delete($receta->imagen);
            }
            $rutaImagen = $request->file('imagen')->store('recetas', 'public');
        }

        $receta->update([
            'nombre_receta'      => $validated['nombre_receta'],
            'slug'               => $this->makeUniqueSlug($validated['nombre_receta'], $receta->id_receta),
            'cantidad_porciones' => $validated['cantidad_porciones'],
            'tipo_porcion'       => $validated['tipo_porcion'],
            'descripcion'        => $validated['descripcion'] ?? null,
            'procedimiento'      => $validated['procedimiento'] ?? null,
            'imagen'             => $rutaImagen,
        ]);

        $this->syncIngredientes($receta, $request->input('ingredientes', []));

        return redirect()->route('profile.recetas.show', $receta)->with('status', 'success-receta-update');

    }

    public function recetaviewShow(Receta $receta)
    {
        $receta->load('ingredientes');
        return view('profile.recetas.show', ['receta' => $receta]);
    }

    public function recetaviewEdit(Receta $receta)
    {
        $receta->load('ingredientes');
        return view('profile.recetas.edit', ['receta' => $receta]);
    }

    public function recetaviewDestroy(Receta $receta)
    {
        if ($receta->imagen) {
            Storage::disk('public')->delete($receta->imagen);
        }

        $receta->delete();

        return redirect()->route('profile.recetas')->with('status', 'success-receta-delete');
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

                $ingrediente = Ingrediente::updateOrCreate(
                    ['nombre' => $nombre],
                    [
                        'unidad_medida' => $unidad,
                        'presentacion_cantidad' => $ing['presentacion_cantidad'] ?? null,
                        'presentacion_unidad' => $presentacionUnidad,
                        'costo_presentacion' => $ing['costo_presentacion'] ?? null,
                    ]
                );


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
