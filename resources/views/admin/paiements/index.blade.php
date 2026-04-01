@extends('layouts.app')
 
@section('page-title', 'Paiements')
 
@section('content')
 
<!-- STATS -->
<div class="stats-grid" style="margin-bottom:28px;">
    <div class="stat-card">
        <div class="stat-icon" style="background:#E8FFF5;">💰</div>
        <div>
            <div class="stat-num">{{ $paiements->where('statut', 'Payé')->count() }}</div>
            <div class="stat-label">Paiements validés</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#FFE8E8;">⏳</div>
        <div>
            <div class="stat-num">{{ $paiements->where('statut', 'Non payé')->count() }}</div>
            <div class="stat-label">Non payés</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#F0FFC3;">💵</div>
        <div>
            <div class="stat-num">{{ $paiements->where('statut', 'Payé')->sum('montant') }} DH</div>
            <div class="stat-label">Total encaissé</div>
        </div>
    </div>
</div>
 
<div class="card">
    <div class="card-header">
        <div class="card-title">💰 Gestion des Paiements</div>
        <a href="/admin/paiements/create" class="btn btn-primary">+ Ajouter un paiement</a>
    </div>
 
    <!-- FILTRES -->
    <form method="GET" action="/admin/paiements" style="display:flex; gap:16px; margin-bottom:24px; flex-wrap:wrap; align-items:flex-end;">
        <div>
            <label class="form-label">Filtrer par mois</label>
            <select name="mois" class="form-control" style="width:200px;">
                <option value="">-- Tous les mois --</option>
                @foreach($moisDisponibles as $m)
                    <option value="{{ $m }}" {{ $mois == $m ? 'selected' : '' }}>{{ $m }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="form-label">Filtrer par statut</label>
            <select name="statut" class="form-control" style="width:200px;">
                <option value="">-- Tous --</option>
                <option value="Payé" {{ $statut == 'Payé' ? 'selected' : '' }}>✅ Payé</option>
                <option value="Non payé" {{ $statut == 'Non payé' ? 'selected' : '' }}>⏳ Non payé</option>
            </select>
        </div>
        <div style="display:flex; gap:8px;">
            <button type="submit" class="btn btn-primary">🔍 Filtrer</button>
            <a href="/admin/paiements" class="btn btn-warning">↺ Réinitialiser</a>
        </div>
    </form>
 
    <!-- TABLEAU -->
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Élève</th>
                <th>Mois</th>
                <th>Montant</th>
                <th>Statut</th>
                <th>Date paiement</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($paiements as $paiement)
            <tr>
                <td><strong>#{{ $paiement->id }}</strong></td>
                <td>
                    {{ $paiement->inscription->eleve->nom ?? '-' }}
                    {{ $paiement->inscription->eleve->prenom ?? '' }}
                    <br>
                    <small style="color:#888;">{{ $paiement->inscription->eleve->telephone ?? '' }}</small>
                </td>
                <td><span class="badge badge-info">📅 {{ $paiement->mois }}</span></td>
                <td><strong>{{ $paiement->montant }} DH</strong></td>
                <td>
                    @if($paiement->statut == 'Payé')
                        <span class="badge badge-success">✅ Payé</span>
                    @else
                        <span class="badge badge-danger">⏳ Non payé</span>
                    @endif
                </td>
                <td>{{ $paiement->date_paiement ?? '-' }}</td>
                <td style="display:flex; gap:6px;">
                    @if($paiement->statut == 'Non payé')
                    <form action="/admin/paiements/{{ $paiement->id }}/valider" method="POST">
                        @csrf @method('PUT')
                        <button class="btn btn-primary btn-sm">✅ Valider</button>
                    </form>
                    @endif
                    <form action="/admin/paiements/{{ $paiement->id }}" method="POST"
                          onsubmit="return confirm('Supprimer ce paiement ?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">🗑</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; color:#888; padding:40px;">
                        Aucun paiement trouvé
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
 