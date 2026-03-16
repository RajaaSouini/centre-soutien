<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Inscription extends Model
{
    use HasFactory;
 
    protected $table = 'inscriptions';
 
    protected $fillable = [
        'date',
        'statut',
        'prix',
        'eleve_id',
    ];
 
    // Une inscription appartient à un élève
    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'eleve_id');
    }
}