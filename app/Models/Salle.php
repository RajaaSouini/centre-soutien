<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Salle extends Model
{
    use HasFactory;
 
    protected $table = 'salles';
 
    protected $fillable = [
        'nom',
        'capacite',
        'statut',
    ];
 
    // Une salle a plusieurs plannings
    public function plannings()
    {
        return $this->hasMany(Planning::class, 'salle_id');
    }
}