@extends('layouts.app')
 
@section('page-title', 'Modifier une Activité')
 
@section('content')
<div class="card" style="max-width:600px;">
    <div class="card-header">
        <div class="card-title">✏️ Modifier l'Activité</div>
        <a href="/admin/activites" class="btn btn-warning btn-sm">← Retour</a>
    </div>
    <form action="/admin/activites/{{ $activite->id }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-group">
            <label class="form-label">Titre *</label>
            <input type="text" name="titre" class="form-control" value="{{ $activite->titre }}" required>
        </div>
        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ $activite->description }}</textarea>
        </div>
        @if($activite->image)
        <div class="form-group">
            <label class="form-label">Image actuelle</label>
            <img src="{{ asset('storage/' . $activite->image) }}" style="width:100%; border-radius:12px; margin-bottom:10px;">
        </div>
        @endif
        <div class="form-group">
            <label class="form-label">Nouvelle image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>
        <div class="form-group">
            <label class="form-label">Date de création *</label>
            <input type="date" name="date_creation" class="form-control" value="{{ $activite->date_creation }}" required>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;">✅ Mettre à jour</button>
    </form>
</div>
@endsection