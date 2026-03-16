@extends('layouts.app')

@section('content')
<h2 class="mb-4" style="color:#1A3C5E;">Liste des Cours</h2>

@if($cours->isEmpty())
    <div class="alert alert-info">Aucun cours disponible pour le moment.</div>
@else
    <div class="row">
        @foreach($cours as $c)
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title" style="color:#4A90D9;">{{ $c->nom }}</h5>
                    <p class="card-text">{{ $c->description }}</p>
                    <span class="badge bg-warning text-dark">{{ $c->duree }}</span>
                    @if($c->classe)
                        <p class="mt-2 mb-0"><small>Classe : {{ $c->classe->nom }}</small></p>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
