@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 style="color:#1A3C5E;">Gestion des Activités</h2>
    <a href="/admin/activites/create" class="btn btn-warning fw-bold">+ Ajouter une activité</a>
</div>

@if($activites->isEmpty())
    <div class="alert alert-info">Aucune activité disponible.</div>
@else
    <div class="row">
        @foreach($activites as $activite)
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                @if($activite->image)
                    <img src="{{ asset('storage/' . $activite->image) }}"
                         class="card-img-top"
                         style="height:200px; object-fit:cover;">
                @else
                    <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                         style="height:200px;">
                        <span>Pas d'image</span>
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title fw-bold" style="color:#1A3C5E;">{{ $activite->titre }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($activite->description, 80) }}</p>
                    <small class="text-muted">{{ $activite->date_creation }}</small>
                </div>
                <div class="card-footer d-flex gap-2">
                    <a href="/admin/activites/{{ $activite->id }}/edit"
                       class="btn btn-primary btn-sm w-50">Modifier</a>
                    <form action="/admin/activites/{{ $activite->id }}" method="POST" class="w-50"
                          onsubmit="return confirm('Supprimer cette activité ?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm w-100">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection