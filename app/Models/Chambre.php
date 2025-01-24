<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    use HasFactory;

    /**
     * Les attributs assignables.
     */
    protected $fillable = [
        'nom', 'prix', 'description', 'categorie', 'disponibilite', 'images'
    ];

    // Définir l'attribut 'images' comme un tableau JSON
   
    protected $casts = [
        'disponibilite' => 'string',
        'images' => 'array', // cela va automatiquement convertir le champ JSON en tableau

    ];

     // Relation avec les images
  
}
