@extends('layouts.app')
 
@section('page-title', 'Ajouter un Cours')
 
@section('content')
<div class="card" style="max-width:600px;">
    <div class="card-header">
        <div class="card-title">➕ Nouveau Cours</div>
        <a href="/admin/cours" class="btn btn-warning btn-sm">← Retour</a>
    </div>
    <form action="/admin/cours" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Nom du cours *</label>
            <input type="text" name="nom" class="form-control" required placeholder="Ex: Mathématiques">
        </div>
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3" placeholder="Description du cours..."></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Durée</label>
            <input type="text" name="duree" class="form-control" placeholder="Ex: 2h">
        </div>
        <div class="form-group">
            <label class="form-label">Classe *</label>
            <select name="classe_scolaire_id" class="form-control" required>
                <option value="">-- Choisir une classe --</option>
                @foreach($classes as $classe)
                    <option value="{{ $classe->id }}">{{ $classe->nom }} ({{ $classe->niveau->nom }})</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Planning *</label>
            <select name="planning_id" class="form-control" required>
                <option value="">-- Choisir un planning --</option>
                @foreach($plannings as $planning)
                    <option value="{{ $planning->id }}">{{ $planning->jour }} {{ $planning->heure_debut }}-{{ $planning->heure_fin }} ({{ $planning->salle->nom ?? '-' }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;">✅ Enregistrer</button>
    </form>
</div>
@endsection