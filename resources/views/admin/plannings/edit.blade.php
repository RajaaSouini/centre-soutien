@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header fw-bold text-white" style="background-color:#1A3C5E;">
                Modifier le Planning
            </div>
            <div class="card-body">
                <form action="/admin/plannings/{{ $planning->id }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Jour</label>
                        <select name="jour" class="form-select" required>
                            @foreach(['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'] as $jour)
                            <option value="{{ $jour }}"
                                {{ $planning->jour == $jour ? 'selected' : '' }}>
                                {{ $jour }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Heure Début</label>
                        <input type="time" name="heure_debut" class="form-control"
                               value="{{ $planning->heure_debut }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Heure Fin</label>
                        <input type="time" name="heure_fin" class="form-control"
                               value="{{ $planning->heure_fin }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Salle</label>
                        <select name="salle_id" class="form-select" required>
                            @foreach($salles as $salle)
                            <option value="{{ $salle->id }}"
                                {{ $planning->salle_id == $salle->id ? 'selected' : '' }}>
                                {{ $salle->nom }} ({{ $salle->statut }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary fw-bold">Mettre à jour</button>
                        <a href="/admin/plannings" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
