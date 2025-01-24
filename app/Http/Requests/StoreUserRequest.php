<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à effectuer cette requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Les règles de validation qui s'appliquent à la requête.
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'regex:/@gmail\.com$/',
                'unique:users',
            ],
            'phone_number' => [
                'required',
                'string',
                'regex:/^(77|78|76|70)[0-9]{7}$/',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*\d).+$/', // Au moins une majuscule et un chiffre
                'confirmed',
            ],
        ];
    }

    /**
     * Les messages d'erreur personnalisés pour chaque règle.
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'Le prénom est obligatoire.',
            'last_name.required' => 'Le nom est obligatoire.',
            'email.required' => "L'adresse email est obligatoire.",
            'email.regex' => "L'adresse email doit se terminer par @gmail.com.",
            'email.unique' => "Cette adresse email est déjà utilisée.",
            'phone_number.required' => 'Le numéro de téléphone est obligatoire.',
            'phone_number.regex' => 'Le numéro de téléphone doit commencer par 77, 78, 76 ou 70 et contenir 9 chiffres.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.regex' => 'Le mot de passe doit commencer par une majuscule, contenir au moins un chiffre et avoir 8 caractères minimum.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ];
    }
}
