<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Cours;
 
class CoursController extends Controller
{
    // Liste des cours
    public function index()
{
    $cours = Cours::with('classe.niveau')->get();
    return view('cours.index', compact('cours'));
}
 
    // Créer un cours
    public function store(Request $request)
    {
        $request->validate([
            'nom'                => 'required|string|max:150',
            'description'        => 'nullable|string',
            'duree'              => 'nullable|string',
            'classe_scolaire_id' => 'required|exists:classes_scolaires,id',
            'planning_id'        => 'required|exists:plannings,id',
        ]);
 
        $cours = Cours::create($request->all());
 
        return response()->json([
            'message' => 'Cours créé avec succès',
            'cours'   => $cours,
        ], 201);
    }
 
    // Modifier un cours
    public function update(Request $request, $id)
    {
        $cours = Cours::findOrFail($id);
        $cours->update($request->all());
 
        return response()->json([
            'message' => 'Cours modifié avec succès',
            'cours'   => $cours,
        ]);
    }
 
    // Supprimer un cours
    public function destroy($id)
    {
        $cours = Cours::findOrFail($id);
        $cours->delete();
 
        return response()->json([
            'message' => 'Cours supprimé'
        ]);
    }
}
