<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chambre;

class ChambreController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|integer',
            'description' => 'required|string',
            'categorie' => 'required|string|max:255',
            'capacite' => 'required|integer',
            'disponibilite' => 'required|in:oui,non',
        ]);

        $chambre = Chambre::create([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'description' => $request->description,
            'categorie' => $request->categorie,
            'capacite' => $request->capacite,
            'disponibilite' => $request->disponibilite,
        ]);

        return response()->json([
            'message' => 'Ajout de chambre réussie.',
            'chambre' => $chambre,
        ], 201);
    }
}
