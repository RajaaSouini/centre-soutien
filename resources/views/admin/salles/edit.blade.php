@extends('layouts.app')
 
@section('page-title', 'Modifier une Salle')
 
@section('content')
<div class="card" style="max-width:500px;">
    <div class="card-header">
        <div class="card-title">✏️ Modifier la Salle</div>
        <a href="/admin/salles" class="btn btn-warning btn-sm">← Retour</a>
    </div>
    <form action="/admin/salles/{{ $salle->id }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label class="form-label">Nom de la salle *</label>
            <input type="text" name="nom" class="form-control" value="{{ $salle->nom }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Capacité *</label>
            <input type="number" name="capacite" class="form-control" value="{{ $salle->capacite }}" required min="1">
        </div>
        <div class="form-group">
            <label class="form-label">Statut</label>
            <select name="statut" class="form-control">
                <option value="Disponible" {{ $salle->statut == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="Occupee" {{ $salle->statut == 'Occupee' ? 'selected' : '' }}>Occupée</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;">✅ Mettre à jour</button>
    </form>
</div>
@endsection
