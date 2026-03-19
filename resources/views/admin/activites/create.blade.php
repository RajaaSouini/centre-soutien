@extends('layouts.app')
 
@section('page-title', 'Ajouter une Activité')
 
@section('content')
<div class="card" style="max-width:600px;">
    <div class="card-header">
        <div class="card-title">➕ Nouvelle Activité</div>
        <a href="/admin/activites" class="btn btn-warning btn-sm">← Retour</a>
    </div>
    <form action="/admin/activites" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="form-label">Titre *</label>
            <input type="text" name="titre" class="form-control" required placeholder="Ex: Atelier peinture">
        </div>
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Description de l'activité..."></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <div class="form-group">
            <label class="form-label">Date de création *</label>
            <input type="date" name="date_creation" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;">✅ Enregistrer</button>
    </form>
</div>
@endsection