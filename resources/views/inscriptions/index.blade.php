@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 style="color:#1A3C5E;">Gestion des Inscriptions</h2>
</div>

<table class="table table-bordered table-hover bg-white shadow-sm">
    <thead style="background-color:#1A3C5E; color:white;">
        <tr>
            <th>#</th>
            <th>Nom & Prénom</th>
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
            <td>{{ $inscription->id }}</td>
            <td>{{ $inscription->eleve->nom }} {{ $inscription->eleve->prenom }}</td>
            <td>{{ $inscription->eleve->telephone }}</td>
            <td>{{ $inscription->eleve->classe->nom ?? '-' }}</td>
            <td>{{ $inscription->eleve->classe->niveau->nom ?? '-' }}</td>
            <td>{{ $inscription->date }}</td>
            <td>
                @if($inscription->statut == 'En attente')
                    <span class="badge bg-warning text-dark">En attente</span>
                @elseif($inscription->statut == 'Confirme')
                    <span class="badge bg-success">Confirmé</span>
                @else
                    <span class="badge bg-danger">Refusé</span>
                @endif
            </td>
            <td>{{ $inscription->prix ? $inscription->prix.' DH' : '-' }}</td>
            <td>
                @if($inscription->statut == 'En attente')
                <form action="/admin/inscriptions/{{ $inscription->id }}/confirmer" method="POST" class="d-inline">
                    @csrf @method('PUT')
                    <input type="number" name="prix" placeholder="Prix" class="form-control form-control-sm d-inline" style="width:80px;">
                    <button class="btn btn-success btn-sm">Confirmer</button>
                </form>
                <form action="/admin/inscriptions/{{ $inscription->id }}/refuser" method="POST" class="d-inline">
                    @csrf @method('PUT')
                    <button class="btn btn-danger btn-sm">Refuser</button>
                </form>
                @endif
                <form action="/admin/inscriptions/{{ $inscription->id }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Supprimer cette inscription ?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-secondary btn-sm">Supprimer</button>
                </form>
            </td>
        </tr>
        @empty
            <tr><td colspan="9" class="text-center">Aucune inscription</td></tr>
        @endforelse
    </tbody>
</table>
@endsection