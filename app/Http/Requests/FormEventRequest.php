<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class FormEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * Créer les regles de validation des données pour la creation d'evenement
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'nom_evenement' => ['required', 'min:4'],
            'slug' => ['required', 'regex:/^[a-z0-9\-]+$/', Rule::unique('event')->ignore($this->route()->parameters('event'))]
        ];
    }


    protected function prepareForValidation()
    {
        //Produit un slug valide en cas d'absence.
        $this->merge([
            'slug' => $this->input('slug') ?: Str::slug($this->input('nom_evenement'))
        ]);
    }
}
