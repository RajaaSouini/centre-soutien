@extends('layouts.app')
 
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header fw-bold text-white" style="background-color:#1A3C5E;">
                Modifier le Cours
            </div>
            <div class="card-body">
                <form action="/admin/cours/{{ $cours->id }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nom du cours</label>
                        <input type="text" name="nom" class="form-control"
                               value="{{ $cours->nom }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ $cours->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Durée</label>
                        <input type="text" name="duree" class="form-control"
                               value="{{ $cours->duree }}" placeholder="ex: 2h">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Classe</label>
                        <select name="classe_scolaire_id" class="form-select" required>
                            @foreach($classes as $classe)
                            <option value="{{ $classe->id }}"
                                {{ $cours->classe_scolaire_id == $classe->id ? 'selected' : '' }}>
                                {{ $classe->nom }} ({{ $classe->niveau->nom }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Planning</label>
                        <select name="planning_id" class="form-select" required>
                            @foreach($plannings as $planning)
                            <option value="{{ $planning->id }}"
                                {{ $cours->planning_id == $planning->id ? 'selected' : '' }}>
                                {{ $planning->jour }} {{ $planning->heure_debut }}-{{ $planning->heure_fin }}
                                ({{ $planning->salle->nom ?? '-' }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary fw-bold">Mettre à jour</button>
                        <a href="/admin/cours" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection