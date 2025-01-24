<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'idChambre' => 'required|exists:chambres,id',
            'idClient' => 'required|exists:users,id',
            'nbr_person' => 'required|integer',
            'montant' => 'required|integer',
            'deb_reservation' => 'required|date',
            'fin_reservation' => 'required|date|after_or_equal:deb_reservation',
        ]);

        $reservation = Reservation::create([
            'idChambre' => $request->idChambre,
            'idClient' => $request->idClient,
            'nbr_person' => $request->nbr_person,
            'montant' => $request->montant,
            'deb_reservation' => $request->deb_reservation,
            'fin_reservation' => $request->fin_reservation,
        ]);

        return response()->json([
            'message' => 'Votre réservation a été enregistréé',
            'reservation' => $reservation,
        ], 201);
    }
}
