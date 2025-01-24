<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    /**
     * Inscription d'un utilisateur (client par défaut).
     */
    public function register(StoreUserRequest $request)
    {
        // Les données validées sont automatiquement disponibles dans $request->validated()
        $validatedData = $request->validated();

        // Création de l'utilisateur avec les données validées
        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'role' => 'client', // Rôle par défaut
            'password' => Hash::make($validatedData['password']),
        ]);

        return response()->json([
            'message' => 'Utilisateur enregistré avec succès.',
            'user' => $user,
        ], 201);
    }
    

  
    public function login(Request $request)
    {
        // Validation des champs
        $request->validate([
            'email' => [
                'required',
                'email',
                'regex:/@gmail\.com$/', // Vérifie que l'email termine par @gmail.com
            ],
            'password' => 'required|string',
        ], [
            'email.regex' => "L'adresse email doit se terminer par @gmail.com.",
        ]);

        // Récupération de l'utilisateur par email
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Identifiants invalides'], 401);
        }

        // Création d'un token avec Passport
        $token = $user->createToken('Personal Access Token')->accessToken;

        return response()->json([
            'message' => 'Connexion réussie.',
            'user' => $user,
            'token' => $token,
        ], 200);
    }
}