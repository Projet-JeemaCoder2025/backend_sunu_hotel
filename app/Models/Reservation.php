<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'idChambre',
        'idClient',
        'nbr_person',
        'montant',
        'deb_reservation',
        'fin_reservation',
    ];
}
