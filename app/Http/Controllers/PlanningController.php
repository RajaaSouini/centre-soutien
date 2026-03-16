<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Planning;
use App\Models\Salle;
 
class PlanningController extends Controller
{
    
    public function index()
    {
        $plannings = Planning::with('salle', 'cours')->get();
        return view('admin.plannings.index', compact('plannings'));
    }
 
    public function create()
    {
        $salles = Salle::all();
        return view('admin.plannings.create', compact('salles'));
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'jour'        => 'required|string',
            'heure_debut' => 'required',
            'heure_fin'   => 'required',
            'salle_id'    => 'required|exists:salles,id',
        ]);
 
        Planning::create($request->all());
 
        // Mettre à jour le statut de la salle à Occupée
        Salle::where('id', $request->salle_id)->update(['statut' => 'Occupee']);
 
        return redirect('/admin/plannings')->with('success', 'Planning ajouté avec succès !');
    }
 
    public function edit($id)
    {
        $planning = Planning::findOrFail($id);
        $salles = Salle::all();
        return view('admin.plannings.edit', compact('planning', 'salles'));
    }
 
    public function update(Request $request, $id)
    {
        $planning = Planning::findOrFail($id);
        $planning->update($request->all());
 
        return redirect('/admin/plannings')->with('success', 'Planning modifié avec succès !');
    }
 
    public function destroy($id)
    {
        $planning = Planning::findOrFail($id);
 
        // Remettre la salle disponible
        Salle::where('id', $planning->salle_id)->update(['statut' => 'Disponible']);
 
        $planning->delete();
 
        return redirect('/admin/plannings')->with('success', 'Planning supprimé !');
    }
}
 