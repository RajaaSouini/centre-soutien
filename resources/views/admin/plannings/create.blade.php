@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header fw-bold text-white" style="background-color:#1A3C5E;">
                Ajouter un Planning
            </div>
            <div class="card-body">
                <form action="/admin/plannings" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Jour</label>
                        <select name="jour" class="form-select" required>
                            <option value="">-- Choisir un jour --</option>
                            <option value="Lundi">Lundi</option>
                            <option value="Mardi">Mardi</option>
                            <option value="Mercredi">Mercredi</option>
                            <option value="Jeudi">Jeudi</option>
                            <option value="Vendredi">Vendredi</option>
                            <option value="Samedi">Samedi</option>
                            <option value="Dimanche">Dimanche</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Heure Début</label>
                        <input type="time" name="heure_debut" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Heure Fin</label>
                        <input type="time" name="heure_fin" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Salle</label>
                        <select name="salle_id" class="form-select" required>
                            <option value="">-- Choisir une salle --</option>
                            @foreach($salles as $salle)
                                <option value="{{ $salle->id }}">
                                    {{ $salle->nom }} ({{ $salle->statut }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning fw-bold">Enregistrer</button>
                        <a href="/admin/plannings" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

