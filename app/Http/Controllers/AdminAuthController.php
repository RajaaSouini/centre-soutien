<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrateur;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    // Afficher le formulaire
    public function showLogin()
    {
        return view('admin.login');
    }

    // Connexion
    public function login(Request $request)
    {
        $request->validate([
            'identifiant'  => 'required|string',
            'mot_de_passe' => 'required|string',
        ]);

        $admin = Administrateur::where('identifiant', $request->identifiant)->first();

        if (!$admin || !Hash::check($request->mot_de_passe, $admin->mot_de_passe)) {
            return back()->with('error', 'Identifiant ou mot de passe incorrect');
        }

        session(['admin' => $admin]);
        return redirect('/admin/inscriptions')->with('success', 'Bienvenue ' . $admin->identifiant);
    }

    // Déconnexion
    public function logout(Request $request)
    {
        session()->forget('admin');
        return redirect('/admin/login')->with('success', 'Déconnexion réussie');
    }
}