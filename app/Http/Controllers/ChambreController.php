<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use Illuminate\Http\Request;

class ChambreController extends Controller
{
    /**
     * Ajouter une nouvelle chambre avec des images.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'receptioniste') {
            return response()->json(['message' => 'Accès refusé'], 403);
        }

        // Validation des données
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'categorie' => 'required|string|max:255',
            'disponibilite' => 'nullable|in:oui,non', // Validation enum avec 'oui' ou 'non'
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation des images
            ]);

        // Stockage des images
        $imagesPaths = [];
        if ($request->has('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store('images', 'public');
                $imagesPaths[] = $path; // Ajoute chaque chemin d'image à un tableau
            }
        }

        // Création de la chambre et ajout des images
        $chambre = Chambre::create([
            'nom' => $validated['nom'],
            'prix' => $validated['prix'],
            'description' => $validated['description'],
            'categorie' => $validated['categorie'],
            'disponibilite' => $validated['disponibilite'], // Utilise la valeur saisie par l'utilisateur
            'images' => $imagesPaths, // Stocke les chemins des images dans le champ 'images'
        ]);

        return response()->json([
            'message' => 'Chambre ajoutée avec succès',
            'data' => $chambre,
        ], 201);
    }

    public function index()
{
    // Vérifie si l'utilisateur est authentifié avec le rôle approprié
    if (auth()->user()->role !== 'receptioniste' && auth()->user()->role !== 'admin') {
        return response()->json(['message' => 'Accès refusé'], 403);
    }

    // Récupère toutes les chambres avec leurs images
    $chambres = Chambre::all();

    return response()->json([
        'message' => 'Liste des chambres récupérée avec succès',
        'data' => $chambres,
    ], 200);
}

    /**
     * Met à jour une chambre avec ses images.
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'receptioniste') {
            return response()->json(['message' => 'Accès refusé'], 403);
        }

        $chambre = Chambre::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'string|max:255',
            'prix' => 'integer|min:0',
            'description' => 'nullable|string',
            'categorie' => 'string|max:255',
            'disponibilite' => 'nullable|in:oui,non', // Validation enum avec 'oui' ou 'non'
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation des images
        ]);

        // Mise à jour des images si elles sont envoyées
        $imagesPaths = $chambre->images ?? [];
        if ($request->has('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store('images', 'public');
                $imagesPaths[] = $path; // Ajoute le chemin de la nouvelle image
            }
        }

        // Mise à jour de la chambre
        $chambre->update([
            'nom' => $validated['nom'] ?? $chambre->nom,
            'prix' => $validated['prix'] ?? $chambre->prix,
            'description' => $validated['description'] ?? $chambre->description,
            'categorie' => $validated['categorie'] ?? $chambre->categorie,
            'disponibilite' => $validated['disponibilite'] ?? $chambre->disponibilite,
            'images' => $imagesPaths, // Mise à jour des images
        ]);

        return response()->json([
            'message' => 'Chambre mise à jour avec succès',
            'data' => $chambre,
        ], 200);
    }
}
