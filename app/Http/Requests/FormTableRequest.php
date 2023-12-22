<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormTableRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'nom' => ['required', 'min:4'],
            'duree' => ['regex:/^[0-9]+$/' ],
            'nb_joueur_min' => ['regex:/^[0-9]+$/' ],
            'nb_joueur_max' => ['regex:/^[0-9]+$/' ],
            'description' => ['required', 'min:4'],
            'mj_name' => ['required', 'min:3']

            //Ajout verification clef etrangere que l'event existe bien ?
        ];
    }
    protected function prepareForValidation(): void
    {
        //dd($this->route());
        $this->merge([
            'duree' => floatval($this->duree),
            'nb_joueur_min' => floatval($this->nb_joueur_min),
            'nb_joueur_max' => floatval($this->nb_joueur_max),
        ]);
    }
}
