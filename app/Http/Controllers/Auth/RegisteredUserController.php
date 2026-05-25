<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $normalizedName = preg_replace('/\s+/', ' ', trim((string) $request->input('name')));

        if ($normalizedName !== null) {
            $normalizedName = mb_convert_case($normalizedName, MB_CASE_TITLE, 'UTF-8');
            $request->merge(['name' => $normalizedName]);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[\p{L}]+(?:\s[\p{L}]+)*$/u'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'institution_name' => ['nullable', 'string', 'max:120', 'regex:/^[\p{L}]+(?:\s[\p{L}]+)*$/u'],
            'faculty_name' => ['nullable', 'string', 'max:120', 'regex:/^[\p{L}]+(?:\s[\p{L}]+)*$/u'],
            'terms' => ['accepted'],
            'password' => ['required', 'confirmed', Rules\Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
        ]);

        $user = User::create([
            'nombre' => $request->name,
            'email' => $request->email,
            'institution' => sprintf(
                'Institución "%s" Facultad "%s"',
                trim((string) $request->institution_name),
                trim((string) $request->faculty_name)
            ),
            'contrasena' => Hash::make($request->password),
            'rol' => 'estudiante',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
