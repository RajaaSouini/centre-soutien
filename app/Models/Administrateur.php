<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Administrateur extends Model
{
    use HasFactory;
 
    protected $table = 'administrateurs';
 
    protected $fillable = [
        'identifiant',
        'mot_de_passe',
    ];
 
    protected $hidden = [
        'mot_de_passe',
    ];
}