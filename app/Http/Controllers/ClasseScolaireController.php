<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\ClasseScolaire;
 
class ClasseScolaireController extends Controller
{
    // Liste des classes
    public function index()
    {
        $classes = ClasseScolaire::with('niveau')->get();
        return response()->json($classes);
    }
 
    // Créer une classe
    public function store(Request $request)
    {
        $request->validate([
            'nom'                => 'required|string|max:100',
            'capacite'           => 'required|integer|min:1',
            'niveau_scolaire_id' => 'required|exists:niveaux_scolaires,id',
        ]);
 
        $classe = ClasseScolaire::create($request->all());
 
        return response()->json([
            'message' => 'Classe créée avec succès',
            'classe'  => $classe,
        ], 201);
    }
 
    // Modifier une classe
    public function update(Request $request, $id)
    {
        $classe = ClasseScolaire::findOrFail($id);
        $classe->update($request->all());
 
        return response()->json([
            'message' => 'Classe modifiée avec succès',
            'classe'  => $classe,
        ]);
    }
 
    // Supprimer une classe
    public function destroy($id)
    {
        $classe = ClasseScolaire::findOrFail($id);
        $classe->delete();
 
        return response()->json([
            'message' => 'Classe supprimée'
        ]);
    }
}