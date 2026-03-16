<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Cours extends Model
{
    use HasFactory;
 
    protected $table = 'cours';
 
    protected $fillable = [
        'nom',
        'description',
        'duree',
        'classe_scolaire_id',
        'planning_id',
    ];
 
    // Un cours appartient à une classe
    public function classe()
    {
        return $this->belongsTo(ClasseScolaire::class, 'classe_scolaire_id');
    }
 
    // Un cours appartient à un planning
    public function planning()
    {
        return $this->belongsTo(Planning::class, 'planning_id');
    }
}
