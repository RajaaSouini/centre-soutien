@extends('layouts.app')
 
@section('page-title', 'Modifier un Cours')
 
@section('content')
<div class="card" style="max-width:600px;">
    <div class="card-header">
        <div class="card-title">✏️ Modifier le Cours</div>
        <a href="/admin/cours" class="btn btn-warning btn-sm">← Retour</a>
    </div>
    <form action="/admin/cours/{{ $cours->id }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label class="form-label">Nom du cours *</label>
            <input type="text" name="nom" class="form-control" value="{{ $cours->nom }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $cours->description }}</textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Durée</label>
            <input type="text" name="duree" class="form-control" value="{{ $cours->duree }}">
        </div>
        <div class="form-group">
            <label class="form-label">Classe *</label>
            <select name="classe_scolaire_id" class="form-control" required>
                @foreach($classes as $classe)
                    <option value="{{ $classe->id }}" {{ $cours->classe_scolaire_id == $classe->id ? 'selected' : '' }}>
                        {{ $classe->nom }} ({{ $classe->niveau->nom }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Planning *</label>
            <select name="planning_id" class="form-control" required>
                @foreach($plannings as $planning)
                    <option value="{{ $planning->id }}" {{ $cours->planning_id == $planning->id ? 'selected' : '' }}>
                        {{ $planning->jour }} {{ $planning->heure_debut }}-{{ $planning->heure_fin }} ({{ $planning->salle->nom ?? '-' }})
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;">✅ Mettre à jour</button>
    </form>
</div>
@endsection