<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
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
        // return view('profile.user');
        $user = Auth::user();
        $profile = $user->profile;
        
        return view('profile.user', compact('user', 'profile'));
    }
    
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
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
            'profile_image' => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:5120',
        ]);

        // ACTUALIZAR USUARIO
        $user->update([
            'nombre' => $request->name,
            'email' => $request->email,
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

        return back()->with('status', 'profile-updated');
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
            Storage::disk('public')->delete($profile->profile);
            
            // Eliminar registro de la base de datos
            $profile->delete();
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
            'cover_image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);
        $user = auth()->user();
        $profile = $user->profile;
        if (!$profile) {
            $profile = new Profile();
            $profile->id_user = $user->id_usuario;
        }
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('covers', 'public');
            $profile->cover_image = $path;
        }
        $profile->save();
        return back()->with('status', 'cover-updated');
    }

    public function deleteCover(Request $request): RedirectResponse
    {
        $user = $request->user();
        $profile = Profile::where('id_user', $user->id)->first();

        if ($profile && $profile->cover_imagen) {
            // Eliminar archivo del storage
            if (Storage::disk('public')->exists($profile->cover_image)) {
                Storage::disk('public')->delete($profile->cover_image);
            }
        
            // Eliminar referencia en la base de datos
            $profile->cover_imagen = null;
            $profile->save();
        
            return Redirect::route('profile.user')->with('status', 'cover-deleted');
        }

        return Redirect::route('profile.user')->with('error', 'No se encontró imagen de portada para eliminar');
    }

    public function config(): View {
        return view('profile.configuracion');
    }
}
