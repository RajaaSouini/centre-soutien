<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Cours;
use App\Models\ClasseScolaire;
use App\Models\Planning;
 
class CoursController extends Controller
{

    public function index()
    {
        $cours = Cours::with('classe.niveau', 'planning.salle')->get();
        return view('admin.cours.index', compact('cours'));
    }
 
    public function create()
    {
        $classes  = ClasseScolaire::with('niveau')->get();
        $plannings = Planning::with('salle')->get();
        return view('admin.cours.create', compact('classes', 'plannings'));
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'nom'                => 'required|string|max:150',
            'description'        => 'nullable|string',
            'duree'              => 'nullable|string',
            'classe_scolaire_id' => 'required|exists:classes_scolaires,id',
            'planning_id'        => 'required|exists:plannings,id',
        ]);
 
        Cours::create($request->all());
 
        return redirect('/admin/cours')->with('success', 'Cours ajouté avec succès !');
    }
 
    public function edit($id)
    {
        $cours    = Cours::findOrFail($id);
        $classes  = ClasseScolaire::with('niveau')->get();
        $plannings = Planning::with('salle')->get();
        return view('admin.cours.edit', compact('cours', 'classes', 'plannings'));
    }
 
    public function update(Request $request, $id)
    {
        $cours = Cours::findOrFail($id);
        $cours->update($request->all());
 
        return redirect('/admin/cours')->with('success', 'Cours modifié avec succès !');
    }
 

    public function destroy($id)
    {
        $cours = Cours::findOrFail($id);
        $cours->delete();
 
        return redirect('/admin/cours')->with('success', 'Cours supprimé !');
    }
}
