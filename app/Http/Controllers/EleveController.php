<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Eleve;
 
class EleveController extends Controller
{

    public function index()
    {
        $eleves = Eleve::with('classe.niveau', 'inscriptions')->get();
        return view('admin.eleves.index', compact('eleves'));
    }
 
    
    public function destroy($id)
    {
        $eleve = Eleve::findOrFail($id);
        $eleve->delete();
        return redirect('/admin/eleves')->with('success', 'Élève supprimé !');
    }
}