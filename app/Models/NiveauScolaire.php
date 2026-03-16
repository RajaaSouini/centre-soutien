<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class NiveauScolaire extends Model
{
    use HasFactory;
 
    protected $table = 'niveaux_scolaires';
 
    protected $fillable = [
        'nom',
    ];
 
    // Un niveau a plusieurs classes
    public function classes()
    {
        return $this->hasMany(ClasseScolaire::class, 'niveau_scolaire_id');
    }
}
