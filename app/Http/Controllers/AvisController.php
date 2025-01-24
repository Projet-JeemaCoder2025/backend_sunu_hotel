<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    // Récupération
    public function index()
    {
        return response()->json(Avis::with('client')->get());
    }

    // Ajout d'un avis
    public function store(Request $request)
    {
        $request->validate([
            'idClient' => 'required|exists:users,id',
            'commentaire' => 'required|string',
            'evaluation' => 'required|integer|between:1,5',
        ]);

        $avis = Avis::create($request->all());
        return response()->json($avis, 201);
    }
// Mis à jour 
    public function update(Request $request, $id)
    {
        $avis = Avis::findOrFail($id);

        $request->validate([
            'commentaire' => 'sometimes|string',
            'evaluation' => 'sometimes|integer|between:1,5',
        ]);

        $avis->update($request->all());
        return response()->json($avis);
    }

    public function destroy($id)
    {
        $avis = Avis::findOrFail($id);
        $avis->delete();
        return response()->json(['message' => 'Suppression reussie']);
    }
}
