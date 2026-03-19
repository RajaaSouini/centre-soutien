@extends('layouts.app')
 
@section('page-title', 'Activités')
 
@section('content')
<div class="card-header" style="margin-bottom:24px;">
    <div class="card-title">🎨 Gestion des Activités</div>
    <a href="/admin/activites/create" class="btn btn-primary">+ Ajouter une activité</a>
</div>
 
@if($activites->isEmpty())
    <div class="card" style="text-align:center; padding:60px;">
        <div style="font-size:60px; margin-bottom:16px;">🎭</div>
        <div style="font-family:'Fredoka One',cursive; font-size:24px; color:#2D2D2D; margin-bottom:8px;">Aucune activité</div>
        <p style="color:#888;">Ajoutez votre première activité !</p>
    </div>
@else
    <div class="grid-3">
        @foreach($activites as $activite)
        <div class="img-card">
            @if($activite->image)
                <img src="{{ asset('storage/' . $activite->image) }}" alt="{{ $activite->titre }}">
            @else
                <div class="no-image" style="background:#F0FFC3;">🎨</div>
            @endif
            <div class="img-card-body">
                <div class="img-card-title">{{ $activite->titre }}</div>
                <div class="img-card-desc">{{ Str::limit($activite->description, 80) }}</div>
                <span class="badge badge-info">📅 {{ $activite->date_creation }}</span>
            </div>
            <div class="img-card-footer">
                <a href="/admin/activites/{{ $activite->id }}/edit" class="btn btn-warning btn-sm" style="flex:1; text-align:center;">✏️ Modifier</a>
                <form action="/admin/activites/{{ $activite->id }}" method="POST" onsubmit="return confirm('Supprimer ?')" style="flex:1;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" style="width:100%;">🗑 Supprimer</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection