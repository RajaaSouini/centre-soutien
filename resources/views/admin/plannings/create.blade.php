@extends('layouts.app')
 
@section('page-title', 'Ajouter un Planning')
 
@section('content')
<div class="card" style="max-width:500px;">
    <div class="card-header">
        <div class="card-title">➕ Nouveau Planning</div>
        <a href="/admin/plannings" class="btn btn-warning btn-sm">← Retour</a>
    </div>
    <form action="/admin/plannings" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Jour *</label>
            <select name="jour" class="form-control" required>
                <option value="">-- Choisir un jour --</option>
                @foreach(['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'] as $jour)
                    <option value="{{ $jour }}">{{ $jour }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Heure Début *</label>
            <input type="time" name="heure_debut" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Heure Fin *</label>
            <input type="time" name="heure_fin" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label">Salle *</label>
            <select name="salle_id" class="form-control" required>
                <option value="">-- Choisir une salle --</option>
                @foreach($salles as $salle)
                    <option value="{{ $salle->id }}">{{ $salle->nom }} ({{ $salle->statut }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;">✅ Enregistrer</button>
    </form>
</div>
@endsection