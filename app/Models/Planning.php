<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Planning extends Model
{
    use HasFactory;
 
    protected $table = 'plannings';
 
    protected $fillable = [
        'jour',
        'heure_debut',
        'heure_fin',
        'salle_id',
    ];
 
    // Un planning appartient à une salle
    public function salle()
    {
        return $this->belongsTo(Salle::class, 'salle_id');
    }
 
    // Un planning a plusieurs cours
    public function cours()
    {
        return $this->hasMany(Cours::class, 'planning_id');
    }
}
