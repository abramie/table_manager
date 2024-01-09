<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InscriptionTableRequest extends FormRequest
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


        ];

    }
    protected function prepareForValidation(): void
    {

        $this->merge([
        ]);

        //Probablement ajouter la partie qui permet de decider l'heure de depart d'une table :)
    }

    public function messages(): array
    {
        return [

        ];
    }
}
