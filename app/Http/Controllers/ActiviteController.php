<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activite;

class ActiviteController extends Controller
{
    // Liste des activités
    public function index()
    {
       $activites = Activite::all();
    
    if (request()->expectsJson() || request()->is('api/*')) {
        return response()->json($activites);
    }
    
    return view('admin.activites.index', compact('activites'));
    }

    // Formulaire ajout
    public function create()
    {
        return view('admin.activites.create');
    }

    // Enregistrer
    public function store(Request $request)
{
    $request->validate([
        'titre'         => 'required|string|max:150',
        'description'   => 'nullable|string',
        'date_creation' => 'required|date',
        'image'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('activites', 'public');
    }

    Activite::create($data);

    return redirect('/admin/activites')->with('success', 'Activité ajoutée avec succès !');
}

    // Formulaire modification
    public function edit($id)
    {
        $activite = Activite::findOrFail($id);
        return view('admin.activites.edit', compact('activite'));
    }

    // Mettre à jour
    public function update(Request $request, $id)
{
    $activite = Activite::findOrFail($id);

    $data = $request->all();

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('activites', 'public');
    }

    $activite->update($data);

    return redirect('/admin/activites')->with('success', 'Activité modifiée avec succès !');
}

    // Supprimer
    public function destroy($id)
    {
        $activite = Activite::findOrFail($id);
        $activite->delete();

        return redirect('/admin/activites')
               ->with('success', 'Activité supprimée !');
    }
}
