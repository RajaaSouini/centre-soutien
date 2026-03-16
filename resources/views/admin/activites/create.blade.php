@extends('layouts.app')
 
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header fw-bold text-white" style="background-color:#1A3C5E;">
                Ajouter une Activité
            </div>
            <div class="card-body">
                <form action="/admin/activites" method="POST" enctype="multipart/form-data">
    @csrf
                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" name="titre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date de création</label>
                        <input type="date" name="date_creation" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning fw-bold">Enregistrer</button>
                        <a href="/admin/activites" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection