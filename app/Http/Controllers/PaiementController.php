<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paiement;
use App\Models\Inscription;

class PaiementController extends Controller
{
    // Liste des paiements avec filtre
    public function index(Request $request)
    {
        $mois = $request->get('mois');
        $statut = $request->get('statut');

        $paiements = Paiement::with('inscription.eleve')
            ->when($mois, fn($q) => $q->where('mois', $mois))
            ->when($statut, fn($q) => $q->where('statut', $statut))
            ->get();

        $moisDisponibles = Paiement::select('mois')->distinct()->pluck('mois');

        return view('admin.paiements.index', compact('paiements', 'moisDisponibles', 'mois', 'statut'));
    }

    // Créer un paiement pour une inscription
    public function create()
    {
        $inscriptions = Inscription::with('eleve')
            ->where('statut', 'Confirme')
            ->get();
        return view('admin.paiements.create', compact('inscriptions'));
    }

    // Enregistrer un paiement
    public function store(Request $request)
    {
        $request->validate([
            'inscription_id' => 'required|exists:inscriptions,id',
            'mois'           => 'required|string',
            'montant'        => 'required|numeric|min:0',
        ]);

        Paiement::create([
            'inscription_id' => $request->inscription_id,
            'mois'           => $request->mois,
            'montant'        => $request->montant,
            'statut'         => 'Non payé',
            'date_paiement'  => null,
        ]);

        return redirect('/admin/paiements')
               ->with('success', 'Paiement créé avec succès !');
    }

    // Valider un paiement (marquer comme payé)
    public function valider($id)
    {
        $paiement = Paiement::findOrFail($id);
        $paiement->update([
            'statut'        => 'Payé',
            'date_paiement' => now()->toDateString(),
        ]);

        return redirect('/admin/paiements')
               ->with('success', 'Paiement validé !');
    }

    // Supprimer un paiement
    public function destroy($id)
    {
        $paiement = Paiement::findOrFail($id);
        $paiement->delete();

        return redirect('/admin/paiements')
               ->with('success', 'Paiement supprimé !');
    }
}