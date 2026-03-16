<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salle;

class SalleController extends Controller
{
    
    public function index()
    {
        $salles = Salle::with(['plannings.cours'])->get();
        return view('admin.salles.index', compact('salles'));
    }

    public function create()
    {
        return view('admin.salles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'      => 'required|string|max:100',
            'capacite' => 'required|integer|min:1',
            'statut'   => 'in:Disponible,Occupee',
        ]);

        Salle::create($request->all());

        return redirect('/admin/salles')->with('success', 'Salle ajoutée avec succès !');
    }

    public function edit($id)
    {
        $salle = Salle::findOrFail($id);
        return view('admin.salles.edit', compact('salle'));
    }

    public function update(Request $request, $id)
    {
        $salle = Salle::findOrFail($id);
        $salle->update($request->all());

        return redirect('/admin/salles')->with('success', 'Salle modifiée avec succès !');
    }

    public function destroy($id)
    {
        $salle = Salle::findOrFail($id);
        $salle->delete();

        return redirect('/admin/salles')->with('success', 'Salle supprimée !');
    }
}
