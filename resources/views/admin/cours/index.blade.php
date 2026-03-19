@extends('layouts.app')
 
@section('page-title', 'Cours')
 
@section('content')
<div class="card-header" style="margin-bottom:24px;">
    <div class="card-title">📚 Gestion des Cours</div>
    <a href="/admin/cours/create" class="btn btn-primary">+ Ajouter un cours</a>
</div>
 
<div class="grid-3">
    @forelse($cours as $c)
    <div class="card">
        <div style="display:flex; align-items:center; gap:12px; margin-bottom:16px;">
            <div style="width:46px; height:46px; border-radius:12px; background:#E8E8FF; display:flex; align-items:center; justify-content:center; font-size:22px;">📖</div>
            <div>
                <div style="font-family:'Fredoka One',cursive; font-size:20px; color:#2D2D2D;">{{ $c->nom }}</div>
                @if($c->duree)
                    <span class="badge badge-info">⏱ {{ $c->duree }}</span>
                @endif
            </div>
        </div>
 
        <p style="color:#888; font-size:14px; line-height:1.5; margin-bottom:14px;">{{ Str::limit($c->description, 80) }}</p>
 
        @if($c->classe)
        <div style="margin-bottom:8px;">
            <span class="badge badge-warning">🎓 {{ $c->classe->nom }}</span>
            @if($c->classe->niveau)
                <span class="badge badge-info" style="margin-left:6px;">{{ $c->classe->niveau->nom }}</span>
            @endif
        </div>
        @endif
 
        @if($c->planning)
        <div style="font-size:13px; color:#888; margin-bottom:16px;">
            📅 {{ $c->planning->jour }} • {{ $c->planning->heure_debut }} - {{ $c->planning->heure_fin }}
            @if($c->planning->salle)
                • 🏫 {{ $c->planning->salle->nom }}
            @endif
        </div>
        @endif
 
        <div style="display:flex; gap:8px;">
            <a href="/admin/cours/{{ $c->id }}/edit" class="btn btn-warning btn-sm" style="flex:1; text-align:center;">✏️ Modifier</a>
            <form action="/admin/cours/{{ $c->id }}" method="POST" onsubmit="return confirm('Supprimer ?')" style="flex:1;">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm" style="width:100%;">🗑 Supprimer</button>
            </form>
        </div>
    </div>
    @empty
        <div style="grid-column:1/-1; text-align:center; padding:60px; color:#888;">Aucun cours</div>
    @endforelse
</div>
@endsection