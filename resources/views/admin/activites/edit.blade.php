@extends('layouts.app')
 
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header fw-bold text-white" style="background-color:#1A3C5E;">
                Modifier l'Activité
            </div>
            <div class="card-body">
                <form action="/admin/activites/{{ $activite->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" name="titre" class="form-control"
                               value="{{ $activite->titre }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ $activite->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date de création</label>
                        <input type="date" name="date_creation" class="form-control"
                               value="{{ $activite->date_creation }}" required>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary fw-bold">Mettre à jour</button>
                        <a href="/admin/activites" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection