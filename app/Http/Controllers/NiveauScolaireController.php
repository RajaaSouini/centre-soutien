<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\NiveauScolaire;
 
class NiveauScolaireController extends Controller
{
    // Liste des niveaux
    public function index()
    {
       $niveaux = NiveauScolaire::with('classes')->get();
    
    if (request()->expectsJson()) {
        return response()->json($niveaux);
    }
    
    return view('admin.niveaux.index', compact('niveaux'));
    }
 
    // Créer un niveau
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|in:Primaire,College,Lycee|unique:niveaux_scolaires,nom',
        ]);
 
        $niveau = NiveauScolaire::create($request->all());
 
        return response()->json([
            'message' => 'Niveau créé avec succès',
            'niveau'  => $niveau,
        ], 201);
    }
 
    // Afficher un niveau
    public function show($id)
    {
        $niveau = NiveauScolaire::with('classes.eleves')->findOrFail($id);
        return response()->json($niveau);
    }
 
    // Supprimer un niveau
    public function destroy($id)
    {
        $niveau = NiveauScolaire::findOrFail($id);
        $niveau->delete();
 
        return response()->json([
            'message' => 'Niveau supprimé'
        ]);
    }
}