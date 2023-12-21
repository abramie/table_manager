<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormCreneauRequest extends FormRequest
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
            'nom' => ['required', 'min:4', Rule::unique('creneaux')->ignore($this->creneau)],
            'duree' => ['regex:/^[0-9]+$/' ]
            //Ajout verification clef etrangere que l'event existe bien ?
        ];
    }
    protected function prepareForValidation(): void
    {
        //dd($this->route());
        $this->merge([
            'duree' => floatval($this->duree),
            'evenement_id' => 1
        ]);
    }

}
