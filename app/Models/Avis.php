<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    use HasFactory;

    protected $fillable = ['idClient', 'commentaire', 'evaluation'];

    public function client()
    {
        return $this->belongsTo(User::class, 'idClient');
    }
    
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'idReservation');
    }
}

