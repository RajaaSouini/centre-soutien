<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Salle;
 
class SalleController extends Controller
{
    // Liste des salles
    public function index()
{
    $salles = Salle::all();
    return view('salles.index', compact('salles'));
}
 
    // Créer une salle
    public function store(Request $request)
    {
        $request->validate([
            'nom'      => 'required|string|max:100',
            'capacite' => 'required|integer|min:1',
            'statut'   => 'in:Disponible,Occupee',
        ]);
 
        $salle = Salle::create($request->all());
 
        return response()->json([
            'message' => 'Salle créée avec succès',
            'salle'   => $salle,
        ], 201);
    }
 
    // Modifier une salle
    public function update(Request $request, $id)
    {
        $salle = Salle::findOrFail($id);
        $salle->update($request->all());
 
        return response()->json([
            'message' => 'Salle modifiée avec succès',
            'salle'   => $salle,
        ]);
    }
 
    // Supprimer une salle
    public function destroy($id)
    {
        $salle = Salle::findOrFail($id);
        $salle->delete();
 
        return response()->json([
            'message' => 'Salle supprimée'
        ]);
    }
}
