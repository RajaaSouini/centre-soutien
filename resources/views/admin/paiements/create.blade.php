@extends('layouts.app')
 
@section('page-title', 'Ajouter un Paiement')
 
@section('content')
<div class="card" style="max-width:600px;">
    <div class="card-header">
        <div class="card-title">➕ Nouveau Paiement</div>
        <a href="/admin/paiements" class="btn btn-warning btn-sm">← Retour</a>
    </div>
    <form action="/admin/paiements" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label">Élève (inscription confirmée) *</label>
            <select name="inscription_id" class="form-control" required>
                <option value="">-- Choisir un élève --</option>
                @foreach($inscriptions as $inscription)
                    <option value="{{ $inscription->id }}">
                        {{ $inscription->eleve->nom }} {{ $inscription->eleve->prenom }}
                        — {{ $inscription->eleve->classe->nom ?? '' }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Mois *</label>
            <select name="mois" class="form-control" required>
                <option value="">-- Choisir un mois --</option>
                @foreach(['Janvier 2026','Février 2026','Mars 2026','Avril 2026','Mai 2026','Juin 2026','Juillet 2026','Août 2026','Septembre 2026','Octobre 2026','Novembre 2026','Décembre 2026'] as $m)
                    <option value="{{ $m }}">{{ $m }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Montant (DH) *</label>
            <input type="number" name="montant" class="form-control"
                   required min="0" step="0.01" placeholder="Ex: 500">
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;">✅ Enregistrer</button>
    </form>
</div>
@endsection