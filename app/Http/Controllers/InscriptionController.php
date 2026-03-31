<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscription;

class InscriptionController extends Controller
{

    // Liste des inscriptions (admin)
    public function index()
    {
        $inscriptions = Inscription::with('eleve.classe.niveau')->get();
        return view('inscriptions.index', compact('inscriptions'));
    }

    // Formulaire inscription (public)
    public function create()
    {
        $niveaux = \App\Models\NiveauScolaire::all();
        $classes = \App\Models\ClasseScolaire::with('niveau')->get();
        return view('inscriptions.create', compact('niveaux', 'classes'));
    }

    // Soumettre inscription
    public function store(Request $request)
{
    $request->validate([
        'nom'                => 'required|string',
        'prenom'             => 'required|string',
        'telephone'          => 'required|string',
        'classe_scolaire_id' => 'required|exists:classes_scolaires,id',
    ]);

    $eleve = \App\Models\Eleve::create([
        'nom'                => $request->nom,
        'prenom'             => $request->prenom,
        'telephone'          => $request->telephone,
        'classe_scolaire_id' => $request->classe_scolaire_id,
    ]);

    $inscription = Inscription::create([
        'date'     => now()->toDateString(),
        'statut'   => 'En attente',
        'eleve_id' => $eleve->id,
    ]);

    // Retourner JSON ou redirection selon la requête
    if ($request->expectsJson()) {
        return response()->json([
            'message'     => 'Inscription soumise avec succès',
            'inscription' => $inscription,
            'eleve'       => $eleve,
        ], 201);
    }

    return redirect('/inscriptions/create')
           ->with('success', 'Votre demande d\'inscription a été envoyée avec succès !');
}
    // Confirmer
    public function confirmer(Request $request, $id)
    {
        $inscription = Inscription::findOrFail($id);
        $inscription->update([
            'statut' => 'Confirme',
            'prix'   => $request->prix,
        ]);
        return redirect('/admin/inscriptions')->with('success', 'Inscription confirmée !');
    }

    // Refuser
    public function refuser($id)
    {
        $inscription = Inscription::findOrFail($id);
        $inscription->update(['statut' => 'Refuse']);
        return redirect('/admin/inscriptions')->with('success', 'Inscription refusée.');
    }

    // Supprimer
    public function destroy($id)
    {
        $inscription = Inscription::findOrFail($id);
        $inscription->delete();
        return redirect('/admin/inscriptions')->with('success', 'Inscription supprimée !');
    }

}