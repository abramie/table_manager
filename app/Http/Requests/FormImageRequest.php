<?php

namespace App\Http\Requests;

use App\Models\Settings;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FormImageRequest extends FormRequest
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

            'title' => ['required', 'min:4','regex:/^[0-9]+$/' ],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
    }
///'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

    protected function prepareForValidation()
    {

        $this->merge([

        ]);



    }
}
