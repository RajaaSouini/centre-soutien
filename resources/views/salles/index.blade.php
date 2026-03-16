@extends('layouts.app')

@section('content')
<h2 class="mb-4" style="color:#1A3C5E;">Gestion des Salles</h2>

<table class="table table-bordered table-hover bg-white shadow-sm">
    <thead style="background-color:#1A3C5E; color:white;">
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Capacité</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        @forelse($salles as $salle)
        <tr>
            <td>{{ $salle->id }}</td>
            <td>{{ $salle->nom }}</td>
            <td>{{ $salle->capacite }}</td>
            <td>
                @if($salle->statut == 'Disponible')
                    <span class="badge bg-success">Disponible</span>
                @else
                    <span class="badge bg-danger">Occupée</span>
                @endif
            </td>
        </tr>
        @empty
            <tr><td colspan="4" class="text-center">Aucune salle</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
