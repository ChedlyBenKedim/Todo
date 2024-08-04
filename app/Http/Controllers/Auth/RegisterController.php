<?php

// app/Http/Controllers/Auth/RegisterController.php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validation des données
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            // Log des erreurs de validation
            Log::warning('Échec de l\'inscription - erreurs de validation', [
                'errors' => $validator->errors(),
                'email' => $request->email,
                'timestamp' => now()
            ]);

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = $this->create($request->all());

        // Log de l'inscription réussie
        Log::info('Nouvel utilisateur inscrit', [
            'email' => $user->email,
            'timestamp' => now()
        ]);

        // Optionnel : Connexion automatique après l'inscription
        // auth()->login($user);

        return redirect('/tasks')->with('success', 'Inscription réussie !');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}

