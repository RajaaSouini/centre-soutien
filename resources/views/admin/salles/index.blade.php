@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 style="color:#1A3C5E;">Gestion des Salles</h2>
    <a href="/admin/salles/create" class="btn btn-warning fw-bold">+ Ajouter une salle</a>
</div>

<div class="row">
    @forelse($salles as $salle)
    <div class="col-md-4 mb-4">
        <div class="card shadow h-100">
            <div class="card-header fw-bold text-white"
                 style="background-color:{{ $salle->statut == 'Disponible' ? '#28a745' : '#dc3545' }}">
                {{ $salle->nom }}
                <span class="float-end badge bg-light text-dark">{{ $salle->statut }}</span>
            </div>
            <div class="card-body">
                <p><strong>Capacité :</strong> {{ $salle->capacite }} places</p>

                <hr>
                <h6 style="color:#4A90D9;">Planning affecté :</h6>
                @if($salle->plannings->isEmpty())
                    <p class="text-muted">Aucun planning</p>
                @else
                    @foreach($salle->plannings as $planning)
                    <div class="mb-2 p-2 bg-light rounded">
                        <strong>{{ $planning->jour }}</strong>
                        {{ $planning->heure_debut }} → {{ $planning->heure_fin }}
                        @if($planning->cours->isNotEmpty())
                            <br><small class="text-primary">
                                Cours : {{ $planning->cours->first()->nom }}
                            </small>
                        @endif
                    </div>
                    @endforeach
                @endif
            </div>
            <div class="card-footer d-flex gap-2">
                <a href="/admin/salles/{{ $salle->id }}/edit"
                   class="btn btn-primary btn-sm w-50">Modifier</a>
                <form action="/admin/salles/{{ $salle->id }}" method="POST" class="w-50"
                      onsubmit="return confirm('Supprimer cette salle ?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm w-100">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
    @empty
        <div class="alert alert-info">Aucune salle disponible.</div>
    @endforelse
</div>
@endsection
