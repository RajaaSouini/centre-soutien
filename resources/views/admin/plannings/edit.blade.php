@extends('layouts.app')
 
@section('page-title', 'Modifier un Planning')
 
@section('content')
<div class="card" style="max-width:500px;">
    <div class="card-header">
        <div class="card-title">✏️ Modifier le Planning</div>
        <a href="/admin/plannings" class="btn btn-warning btn-sm">← Retour</a>
    </div>
    <form action="/admin/plannings/{{ $planning->id }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label class="form-label">Jour *</label>
            <select name="jour" class="form-control" required>
                @foreach(['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'] as $jour)
                    <option value="{{ $jour }}" {{ $planning->jour == $jour ? 'selected' : '' }}>{{ $jour }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Heure Début *</label>
            <input type="time" name="heure_debut" class="form-control" value="{{ $planning->heure_debut }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Heure Fin *</label>
            <input type="time" name="heure_fin" class="form-control" value="{{ $planning->heure_fin }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Salle *</label>
            <select name="salle_id" class="form-control" required>
                @foreach($salles as $salle)
                    <option value="{{ $salle->id }}" {{ $planning->salle_id == $salle->id ? 'selected' : '' }}>
                        {{ $salle->nom }} ({{ $salle->statut }})
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;">✅ Mettre à jour</button>
    </form>
</div>
@endsection
