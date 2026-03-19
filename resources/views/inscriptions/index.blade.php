@extends('layouts.app')
 
@section('page-title', 'Inscriptions')
 
@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">📋 Liste des Inscriptions</div>
        <div style="display:flex; gap:10px; align-items:center;">
            <span class="badge badge-warning">{{ $inscriptions->where('statut', 'En attente')->count() }} en attente</span>
            <span class="badge badge-success">{{ $inscriptions->where('statut', 'Confirme')->count() }} confirmées</span>
        </div>
    </div>
 
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Élève</th>
                <th>Téléphone</th>
                <th>Classe</th>
                <th>Niveau</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inscriptions as $inscription)
            <tr>
                <td><strong>#{{ $inscription->id }}</strong></td>
                <td>{{ $inscription->eleve->nom }} {{ $inscription->eleve->prenom }}</td>
                <td>{{ $inscription->eleve->telephone }}</td>
                <td>{{ $inscription->eleve->classe->nom ?? '-' }}</td>
                <td>{{ $inscription->eleve->classe->niveau->nom ?? '-' }}</td>
                <td>{{ $inscription->date }}</td>
                <td>
                    @if($inscription->statut == 'En attente')
                        <span class="badge badge-warning">⏳ En attente</span>
                    @elseif($inscription->statut == 'Confirme')
                        <span class="badge badge-success">✅ Confirmé</span>
                    @else
                        <span class="badge badge-danger">❌ Refusé</span>
                    @endif
                </td>
                <td>{{ $inscription->prix ? $inscription->prix.' DH' : '-' }}</td>
                <td style="display:flex; gap:6px; flex-wrap:wrap; align-items:center;">
                    @if($inscription->statut == 'En attente')
                    <form action="/admin/inscriptions/{{ $inscription->id }}/confirmer" method="POST" style="display:flex; gap:6px; align-items:center;">
                        @csrf @method('PUT')
                        <input type="number" name="prix" placeholder="Prix DH" class="form-control" style="width:90px; padding:6px 10px; font-size:13px;">
                        <button class="btn btn-primary btn-sm">✅ Confirmer</button>
                    </form>
                    <form action="/admin/inscriptions/{{ $inscription->id }}/refuser" method="POST">
                        @csrf @method('PUT')
                        <button class="btn btn-danger btn-sm">❌ Refuser</button>
                    </form>
                    @endif
                    <form action="/admin/inscriptions/{{ $inscription->id }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">🗑</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr><td colspan="9" style="text-align:center; color:#888; padding:40px;">Aucune inscription</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection