<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Eleve;
 
class EleveController extends Controller
{
    // Liste de tous les élèves
    public function index()
    {
        $eleves = Eleve::with('classe.niveau')->get();
        return response()->json($eleves);
    }
 
    // Créer un élève
    public function store(Request $request)
    {
        $request->validate([
            'nom'                => 'required|string|max:100',
            'prenom'             => 'required|string|max:100',
            'telephone'          => 'required|string|max:20',
            'classe_scolaire_id' => 'required|exists:classes_scolaires,id',
        ]);
 
        $eleve = Eleve::create($request->all());
 
        return response()->json([
            'message' => 'Élève créé avec succès',
            'eleve'   => $eleve,
        ], 201);
    }
 
    // Afficher un élève
    public function show($id)
    {
        $eleve = Eleve::with('classe.niveau', 'inscriptions')->findOrFail($id);
        return response()->json($eleve);
    }
 
    // Modifier un élève
    public function update(Request $request, $id)
    {
        $eleve = Eleve::findOrFail($id);
        $eleve->update($request->all());
 
        return response()->json([
            'message' => 'Élève modifié avec succès',
            'eleve'   => $eleve,
        ]);
    }
 
    // Supprimer un élève
    public function destroy($id)
    {
        $eleve = Eleve::findOrFail($id);
        $eleve->delete();
 
        return response()->json([
            'message' => 'Élève supprimé avec succès'
        ]);
    }
}