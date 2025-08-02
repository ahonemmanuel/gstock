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
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function creae(): View
    {
        return view('auth.register');
    }

    public function create()
    {
        // Récupérer les rôles distincts depuis la table users
        $existingRoles = User::select('role')
            ->distinct()
            ->pluck('role')
            ->toArray();

        return view('auth.register', ['existingRoles' => $existingRoles]);
    }
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    // Dans la méthode create()

// Dans la méthode store()
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role_type' => 'required|in:existing,new',
        ]);

        // Validation conditionnelle
        if ($request->role_type === 'existing') {
            $request->validate([
                'role' => 'required|string|max:255',
            ]);
            $role = $request->role;
        } else {
            $request->validate([
                'new_role' => 'required|string|max:255|unique:users,role',
            ]);
            $role = $request->new_role;
        }

        // Création de l'utilisateur
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        return redirect()->route('dashboard');
    }
    public function stre(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
