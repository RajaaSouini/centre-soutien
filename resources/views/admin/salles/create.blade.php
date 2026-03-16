@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header fw-bold text-white" style="background-color:#1A3C5E;">
                Ajouter une Salle
            </div>
            <div class="card-body">
                <form action="/admin/salles" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nom de la salle</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Capacité</label>
                        <input type="number" name="capacite" class="form-control" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Statut</label>
                        <select name="statut" class="form-select">
                            <option value="Disponible">Disponible</option>
                            <option value="Occupee">Occupée</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning fw-bold">Enregistrer</button>
                        <a href="/admin/salles" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
