<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eleve;
use Illuminate\Support\Facades\Hash;

class EleveAuthController extends Controller
{
    // Inscription
    public function register(Request $request)
    {
        $request->validate([
            'nom'                => 'required|string',
            'prenom'             => 'required|string',
            'telephone'          => 'required|string',
            'email'              => 'required|email|unique:eleves,email',
            'password'           => 'required|min:6',
            'classe_scolaire_id' => 'required|exists:classes_scolaires,id',
        ]);

                $eleve = Eleve::create([
            'nom'                => $request->nom,
            'prenom'             => $request->prenom,
            'telephone'          => $request->telephone,
            'email'              => $request->email,
            'password' => Hash::make($request->password),
            'classe_scolaire_id' => $request->classe_scolaire_id,
        ]);

        \App\Models\Inscription::create([
            'date'     => now()->toDateString(),
            'statut'   => 'En attente',
            'eleve_id' => $eleve->id,
        ]);

        session(['eleve' => $eleve]);

        return response()->json([
            'message' => 'Inscription réussie',
            'eleve'   => $eleve,
        ]);
    }

    // Connexion
    public function login(Request $request)
{
    $request->validate([
        'email'    => 'required',
        'password' => 'required',
    ]);

    // Vérifier si c'est un admin
    $admin = \App\Models\Administrateur::where('identifiant', $request->email)->first();
    if ($admin && \Illuminate\Support\Facades\Hash::check($request->password, $admin->mot_de_passe)) {
        session(['admin' => $admin]);
        return response()->json([
            'message' => 'Connexion admin réussie',
            'role'    => 'admin',
            'user'    => $admin,
        ]);
    }

    // Vérifier si c'est un élève
    $eleve = \App\Models\Eleve::where('email', $request->email)->first();
    if ($eleve && Hash::check($request->password, $eleve->password)) {
        session(['eleve' => $eleve]);
        return response()->json([
            'message' => 'Connexion réussie',
            'role'    => 'eleve',
            'user'    => $eleve,
        ]);
    }

    return response()->json(['message' => 'Email ou mot de passe incorrect'], 401);
}

    // Déconnexion
    public function logout()
    {
        session()->forget('eleve');
        return response()->json(['message' => 'Déconnexion réussie']);
    }

    // Infos élève connecté
    public function me()
    {
        $eleve = session('eleve');
        if (!$eleve) {
            return response()->json(['message' => 'Non connecté'], 401);
        }
        return response()->json($eleve);
    }
}