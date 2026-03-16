@extends('layouts.app')

@section('content')
<h2 class="mb-4" style="color:#1A3C5E;">Formulaire d'Inscription</h2>

<div class="card shadow-sm" style="max-width:600px;">
    <div class="card-body">
        <form action="/inscriptions" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Prénom</label>
                <input type="text" name="prenom" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Téléphone</label>
                <input type="text" name="telephone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Niveau Scolaire</label>
                <select name="niveau_scolaire_id" class="form-select" required>
                    <option value="">-- Choisir un niveau --</option>
                    @foreach($niveaux as $niveau)
                        <option value="{{ $niveau->id }}">{{ $niveau->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Classe</label>
                <select name="classe_scolaire_id" class="form-select" required>
                    <option value="">-- Choisir une classe --</option>
                    @foreach($classes as $classe)
                        <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Envoyer la demande</button>
        </form>
    </div>
</div>
@endsection
