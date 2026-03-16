<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class ClasseScolaire extends Model
{
    use HasFactory;
 
    protected $table = 'classes_scolaires';
 
    protected $fillable = [
        'nom',
        'capacite',
        'niveau_scolaire_id',
    ];
 
    // Une classe appartient à un niveau
    public function niveau()
    {
        return $this->belongsTo(NiveauScolaire::class, 'niveau_scolaire_id');
    }
 
    // Une classe a plusieurs élèves
    public function eleves()
    {
        return $this->hasMany(Eleve::class, 'classe_scolaire_id');
    }
 
    // Une classe a plusieurs cours
    public function cours()
    {
        return $this->hasMany(Cours::class, 'classe_scolaire_id');
    }
}
