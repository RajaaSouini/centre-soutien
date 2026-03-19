@extends('layouts.app')
 
@section('page-title', 'Planning')
 
@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">📅 Gestion des Plannings</div>
        <a href="/admin/plannings/create" class="btn btn-primary">+ Ajouter un planning</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Jour</th>
                <th>Heure Début</th>
                <th>Heure Fin</th>
                <th>Salle</th>
                <th>Cours</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($plannings as $planning)
            <tr>
                <td><strong>#{{ $planning->id }}</strong></td>
                <td><span class="badge badge-info">{{ $planning->jour }}</span></td>
                <td>{{ $planning->heure_debut }}</td>
                <td>{{ $planning->heure_fin }}</td>
                <td>{{ $planning->salle->nom ?? '-' }}</td>
                <td>
                    @if($planning->cours->isNotEmpty())
                        <span class="badge badge-success">{{ $planning->cours->first()->nom }}</span>
                    @else
                        <span style="color:#bbb;">Aucun cours</span>
                    @endif
                </td>
                <td style="display:flex; gap:6px;">
                    <a href="/admin/plannings/{{ $planning->id }}/edit" class="btn btn-warning btn-sm">✏️</a>
                    <form action="/admin/plannings/{{ $planning->id }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">🗑</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr><td colspan="7" style="text-align:center; color:#888; padding:40px;">Aucun planning</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection