<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Planning;
 
class PlanningController extends Controller
{
    // Liste des plannings
    public function index()
    {
        $plannings = Planning::with('salle')->get();
        return response()->json($plannings);
    }
 
    // Créer un planning
    public function store(Request $request)
    {
        $request->validate([
            'jour'        => 'required|string',
            'heure_debut' => 'required',
            'heure_fin'   => 'required',
            'salle_id'    => 'required|exists:salles,id',
        ]);
 
        $planning = Planning::create($request->all());
 
        return response()->json([
            'message'  => 'Planning créé avec succès',
            'planning' => $planning,
        ], 201);
    }
 
    // Modifier un planning
    public function update(Request $request, $id)
    {
        $planning = Planning::findOrFail($id);
        $planning->update($request->all());
 
        return response()->json([
            'message'  => 'Planning modifié avec succès',
            'planning' => $planning,
        ]);
    }
 
    // Supprimer un planning
    public function destroy($id)
    {
        $planning = Planning::findOrFail($id);
        $planning->delete();
 
        return response()->json([
            'message' => 'Planning supprimé'
        ]);
    }
}
