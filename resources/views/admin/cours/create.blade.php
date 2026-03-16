@extends('layouts.app')
 
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header fw-bold text-white" style="background-color:#1A3C5E;">
                Ajouter un Cours
            </div>
            <div class="card-body">
                <form action="/admin/cours" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nom du cours</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Durée</label>
                        <input type="text" name="duree" class="form-control" placeholder="ex: 2h">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Classe</label>
                        <select name="classe_scolaire_id" class="form-select" required>
                            <option value="">-- Choisir une classe --</option>
                            @foreach($classes as $classe)
                                <option value="{{ $classe->id }}">
                                    {{ $classe->nom }} ({{ $classe->niveau->nom }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Planning</label>
                        <select name="planning_id" class="form-select" required>
                            <option value="">-- Choisir un planning --</option>
                            @foreach($plannings as $planning)
                                <option value="{{ $planning->id }}">
                                    {{ $planning->jour }} {{ $planning->heure_debut }}-{{ $planning->heure_fin }}
                                    ({{ $planning->salle->nom ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning fw-bold">Enregistrer</button>
                        <a href="/admin/cours" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection