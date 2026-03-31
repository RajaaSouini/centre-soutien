<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Eleve extends Model
{
    use HasFactory;
 
    protected $table = 'eleves';
    protected $hidden = ['password'];
 
    protected $fillable = [
    'nom',
    'prenom',
    'telephone',
    'email',
    'password',
    'classe_scolaire_id',
];
 
    // Un élève appartient à une classe
    public function classe()
    {
        return $this->belongsTo(ClasseScolaire::class, 'classe_scolaire_id');
    }
 
    // Un élève a plusieurs inscriptions
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'eleve_id');
    }
}