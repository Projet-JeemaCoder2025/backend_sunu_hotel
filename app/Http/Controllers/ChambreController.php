<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chambre;
use App\Models\Image;

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
            'images' => 'required|array',
            'images.*' => 'required|string',
        ]);

        $chambre = Chambre::create([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'description' => $request->description,
            'categorie' => $request->categorie,
            'capacite' => $request->capacite,
            'disponibilite' => $request->disponibilite,
        ]);

        foreach ($request->images as $url) {
            Image::create([
                'url' => $url,
                'idChambre' => $chambre->id,
            ]);
        }
        return response()->json([
            'message' => 'Ajout de chambre réussie.',
            'chambre' => $chambre,
        ], 201);
    }

    //Modification des informations d'une chambre
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'prix' => 'sometimes|required|integer',
            'description' => 'sometimes|required|string',
            'categorie' => 'sometimes|required|string|max:255',
            'capacite' => 'sometimes|required|integer',
            'disponibilite' => 'sometimes|required|in:oui,non',
            'images' => 'sometimes|required|array',
            'images.*' => 'sometimes|required|string',
        ]);

        $chambre = Chambre::findOrFail($id);
        $chambre->update($request->only(['nom', 'prix', 'description', 'categorie', 'capacite', 'disponibilite']));
        if ($request->has('images')) {
            Image::where('idChambre', $chambre->id)->delete();
            foreach ($request->images as $url) {
                Image::create([
                    'url' => $url,
                    'idChambre' => $chambre->id,
                ]);
            }
        }

        return response()->json([
            'message' => 'Chambre mise à jour avec succès.',
            'chambre' => $chambre,
        ], 200);
    }

    // suppression d'une chambre
    public function destroy($id)
    {       
        $chambre = Chambre::findOrFail($id);
        Image::where('idChambre', $chambre->id)->delete();
        $chambre->delete();

        return response()->json([
            'message' => 'Chambre supprimée avec succès.',
        ], 200);
    }
}
