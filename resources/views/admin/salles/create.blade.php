@extends('layouts.app')
 
@section('page-title', 'Ajouter une Salle')
 
@section('content')
<div class="card" style="max-width:500px;">
    <div class="card-header">
        <div class="card-title">➕ Nouvelle Salle</div>
        <a href="/admin/salles" class="btn btn-warning btn-sm">← Retour</a>
    </div>
    <form action="/admin/salles" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Nom de la salle *</label>
            <input type="text" name="nom" class="form-control" required placeholder="Ex: Salle A">
        </div>
        <div class="form-group">
            <label class="form-label">Capacité *</label>
            <input type="number" name="capacite" class="form-control" required min="1" placeholder="Ex: 20">
        </div>
        <div class="form-group">
            <label class="form-label">Statut</label>
            <select name="statut" class="form-control">
                <option value="Disponible">Disponible</option>
                <option value="Occupee">Occupée</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;">✅ Enregistrer</button>
    </form>
</div>
@endsection
