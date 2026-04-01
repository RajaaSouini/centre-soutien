<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $table = 'paiements';

    protected $fillable = [
        'inscription_id',
        'mois',
        'montant',
        'statut',
        'date_paiement',
    ];

    // Un paiement appartient à une inscription
    public function inscription()
    {
        return $this->belongsTo(Inscription::class, 'inscription_id');
    }
}