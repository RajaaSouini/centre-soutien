@extends('layouts.app')
 
@section('page-title', 'Salles')
 
@section('content')
<div class="card-header" style="margin-bottom:24px;">
    <div class="card-title">🏫 Gestion des Salles</div>
    <a href="/admin/salles/create" class="btn btn-primary">+ Ajouter une salle</a>
</div>
 
<div class="grid-3">
    @forelse($salles as $salle)
    <div class="card" style="border-left: 4px solid {{ $salle->statut == 'Disponible' ? '#00C853' : '#FF5B5B' }}">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
            <div style="font-family:'Fredoka One',cursive; font-size:22px;">🏫 {{ $salle->nom }}</div>
            <span class="badge {{ $salle->statut == 'Disponible' ? 'badge-success' : 'badge-danger' }}">
                {{ $salle->statut }}
            </span>
        </div>
        <p style="color:#888; font-size:14px; margin-bottom:16px;">👥 Capacité : <strong>{{ $salle->capacite }} places</strong></p>
 
        @if($salle->plannings->isNotEmpty())
        <div style="background:#F8F8FF; border-radius:12px; padding:12px; margin-bottom:16px;">
            <div style="font-weight:700; color:#685AFF; margin-bottom:8px; font-size:13px;">📅 Plannings :</div>
            @foreach($salle->plannings as $planning)
            <div style="font-size:13px; color:#666; margin-bottom:4px;">
                {{ $planning->jour }} • {{ $planning->heure_debut }} - {{ $planning->heure_fin }}
                @if($planning->cours->isNotEmpty())
                    <span class="badge badge-info" style="margin-left:4px;">{{ $planning->cours->first()->nom }}</span>
                @endif
            </div>
            @endforeach
        </div>
        @endif
 
        <div style="display:flex; gap:8px;">
            <a href="/admin/salles/{{ $salle->id }}/edit" class="btn btn-warning btn-sm" style="flex:1; text-align:center;">✏️ Modifier</a>
            <form action="/admin/salles/{{ $salle->id }}" method="POST" onsubmit="return confirm('Supprimer ?')" style="flex:1;">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm" style="width:100%;">🗑 Supprimer</button>
            </form>
        </div>
    </div>
    @empty
        <div style="grid-column:1/-1; text-align:center; padding:60px; color:#888;">Aucune salle</div>
    @endforelse
</div>
@endsection
