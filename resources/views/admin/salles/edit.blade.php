@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header fw-bold text-white" style="background-color:#1A3C5E;">
                Modifier la Salle
            </div>
            <div class="card-body">
                <form action="/admin/salles/{{ $salle->id }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nom de la salle</label>
                        <input type="text" name="nom" class="form-control"
                               value="{{ $salle->nom }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Capacité</label>
                        <input type="number" name="capacite" class="form-control"
                               value="{{ $salle->capacite }}" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Statut</label>
                        <select name="statut" class="form-select">
                            <option value="Disponible" {{ $salle->statut == 'Disponible' ? 'selected' : '' }}>
                                Disponible
                            </option>
                            <option value="Occupee" {{ $salle->statut == 'Occupee' ? 'selected' : '' }}>
                                Occupée
                            </option>
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary fw-bold">Mettre à jour</button>
                        <a href="/admin/salles" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
