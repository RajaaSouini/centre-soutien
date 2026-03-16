@extends('layouts.app')

@section('content')
<h2 class="mb-4" style="color:#1A3C5E;">Nos Activités</h2>

@if($activites->isEmpty())
    <div class="alert alert-info">Aucune activité disponible pour le moment.</div>
@else
    <div class="row">
        @foreach($activites as $activite)
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title" style="color:#4A90D9;">{{ $activite->titre }}</h5>
                    <p class="card-text">{{ $activite->description }}</p>
                    <small class="text-muted">{{ $activite->date_creation }}</small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
