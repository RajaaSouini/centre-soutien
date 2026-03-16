@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 style="color:#1A3C5E;">Gestion des Plannings</h2>
    <a href="/admin/plannings/create" class="btn btn-warning fw-bold">+ Ajouter un planning</a>
</div>

<table class="table table-bordered table-hover bg-white shadow-sm">
    <thead style="background-color:#1A3C5E; color:white;">
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
            <td>{{ $planning->id }}</td>
            <td>{{ $planning->jour }}</td>
            <td>{{ $planning->heure_debut }}</td>
            <td>{{ $planning->heure_fin }}</td>
            <td>{{ $planning->salle->nom ?? '-' }}</td>
            <td>
                @if($planning->cours->isNotEmpty())
                    {{ $planning->cours->first()->nom }}
                @else
                    <span class="text-muted">Aucun cours</span>
                @endif
            </td>
            <td>
                <a href="/admin/plannings/{{ $planning->id }}/edit"
                   class="btn btn-primary btn-sm">Modifier</a>
                <form action="/admin/plannings/{{ $planning->id }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Supprimer ce planning ?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Supprimer</button>
                </form>
            </td>
        </tr>
        @empty
            <tr><td colspan="7" class="text-center">Aucun planning</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
