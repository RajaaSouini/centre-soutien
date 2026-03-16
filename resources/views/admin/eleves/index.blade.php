@extends('layouts.app')
 
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 style="color:#1A3C5E;">Gestion des Élèves</h2>
</div>
 
<table class="table table-bordered table-hover bg-white shadow-sm">
    <thead style="background-color:#1A3C5E; color:white;">
        <tr>
            <th>#</th>
            <th>Nom & Prénom</th>
            <th>Téléphone</th>
            <th>Classe</th>
            <th>Niveau</th>
            <th>Statut Inscription</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($eleves as $eleve)
        <tr>
            <td>{{ $eleve->id }}</td>
            <td>{{ $eleve->nom }} {{ $eleve->prenom }}</td>
            <td>{{ $eleve->telephone }}</td>
            <td>{{ $eleve->classe->nom ?? '-' }}</td>
            <td>{{ $eleve->classe->niveau->nom ?? '-' }}</td>
            <td>
                @if($eleve->inscriptions->isNotEmpty())
                    @php $statut = $eleve->inscriptions->last()->statut; @endphp
                    @if($statut == 'En attente')
                        <span class="badge bg-warning text-dark">En attente</span>
                    @elseif($statut == 'Confirme')
                        <span class="badge bg-success">Confirmé</span>
                    @else
                        <span class="badge bg-danger">Refusé</span>
                    @endif
                @else
                    <span class="badge bg-secondary">Aucune inscription</span>
                @endif
            </td>
            <td>
                <form action="/admin/eleves/{{ $eleve->id }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Supprimer cet élève ?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Supprimer</button>
                </form>
            </td>
        </tr>
        @empty
            <tr><td colspan="7" class="text-center">Aucun élève</td></tr>
        @endforelse
    </tbody>
</table>
@endsection