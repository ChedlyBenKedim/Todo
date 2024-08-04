<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Log de la tentative de connexion réussie
            Log::info('Utilisateur connecté', ['email' => $request->email, 'timestamp' => now()]);
            return redirect()->intended('tasks'); // Redirection après connexion
        }

        // Log de la tentative de connexion échouée
        Log::warning('Échec de la connexion', ['email' => $request->email, 'timestamp' => now()]);

        return back()->withErrors([
            'email' => 'Les informations d\'identification ne correspondent pas.',
        ]);
    }

    public function logout()
    {
        // Log de la déconnexion
        Log::info('Utilisateur déconnecté', ['email' => Auth::user()->email, 'timestamp' => now()]);

        Auth::logout();
        return redirect('/login');
    }
}

