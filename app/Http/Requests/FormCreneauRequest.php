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
            'nom' => ['required', 'min:4'],
            'duree' => ['regex:/^[0-9]+$/' ],
            'max_tables' => ['regex:/^[0-9]+$/' ],
            'nb_inscription_online_max' => ['regex:/^[0-9]+$/' ],
            'sans_table' => ['required']
            //Ajout verification clef etrangere que l'event existe bien ?
        ];
    }
    protected function prepareForValidation(): void
    {
        //dd($this->request);
        $this->merge([
            'duree' => floatval($this->duree),
            'max_tables' => floatval($this->max_tables),
            'nb_inscription_online_max' => floatval($this->nb_inscription_online_max),
            'sans_table' => (bool)$this->sans_table,
        ]);
    }

}
