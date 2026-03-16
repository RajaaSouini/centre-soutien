@extends('layouts.app')
 
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 style="color:#1A3C5E;">Gestion des Cours</h2>
    <a href="/admin/cours/create" class="btn btn-warning fw-bold">+ Ajouter un cours</a>
</div>
 
<div class="row">
    @forelse($cours as $c)
    <div class="col-md-4 mb-4">
        <div class="card shadow h-100">
            <div class="card-header fw-bold text-white" style="background-color:#4A90D9;">
                {{ $c->nom }}
            </div>
            <div class="card-body">
                <p class="text-muted">{{ Str::limit($c->description, 80) }}</p>
                <p><strong>Durée :</strong> {{ $c->duree ?? '-' }}</p>
                <hr>
                <p>
                    <strong>Classe :</strong>
                    {{ $c->classe->nom ?? '-' }}
                </p>
                <p>
                    <strong>Niveau :</strong>
                    {{ $c->classe->niveau->nom ?? '-' }}
                </p>
                @if($c->planning)
                <hr>
                <p><strong>Planning :</strong></p>
                <p>
                    📅 {{ $c->planning->jour }}
                    {{ $c->planning->heure_debut }} → {{ $c->planning->heure_fin }}
                    <br>
                    🏫 Salle : {{ $c->planning->salle->nom ?? '-' }}
                </p>
                @endif
            </div>
            <div class="card-footer d-flex gap-2">
                <a href="/admin/cours/{{ $c->id }}/edit"
                   class="btn btn-primary btn-sm w-50">Modifier</a>
                <form action="/admin/cours/{{ $c->id }}" method="POST" class="w-50"
                      onsubmit="return confirm('Supprimer ce cours ?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm w-100">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
    @empty
        <div class="alert alert-info">Aucun cours disponible.</div>
    @endforelse
</div>
@endsection