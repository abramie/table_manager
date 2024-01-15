<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
//dd($this->route());
        return [
            //
            'nom_evenement' => ['required', 'min:4'],
            'slug' => ['required', 'regex:/^[a-z0-9\-]+$/', Rule::unique('evenements')->ignore($this->evenement)],
            'max_tables' => ['regex:/^[0-9]+$/' ],
            'nb_inscription_online_max' => ['regex:/^[0-9]+$/' ],
            'date_debut' => ['required', 'date', 'after:today']
        ];
    }


    protected function prepareForValidation()
    {

        //Produit un slug valide en cas d'absence.
        $this->merge([
            'slug' => $this->input('slug') ?: Str::slug($this->input('nom_evenement')),
            'max_tables' => floatval($this->max_tables),
            'nb_inscription_online_max' => floatval($this->nb_inscription_online_max),
            'date_debut' => Carbon::create($this->date_debut),
        ]);

    }
}
