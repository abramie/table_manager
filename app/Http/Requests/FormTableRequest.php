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

    //dd($this->request);
        return [
            //
            'nom' => ['required', 'min:4'],
            'duree' => ['regex:/^[0-9]+$/' , 'lte:max_duree'],
            'nb_joueur_min' => ['regex:/^[0-9]+$/' ],
            'nb_joueur_max' => ['regex:/^[0-9]+$/' ],
            'description' => ['required', 'min:4'],
            'tags' => ['array', 'exists:tags,id'],
            'triggerwarnings' => ['array', 'exists:triggerwarnings,id'],
            'mj' => ['required']


            //Ajout verification clef etrangere que l'event existe bien ?
        ];

        //Ajout regle pour verification jeu https://www.youtube.com/watch?v=zy6ByXZ9DZ4&list=PLjwdMgw5TTLXz1GRhKxSWYyDHwVW-gqrm&index=12 vers 27 minutes
        //Ajout regle validation nombre de tables ? (qui serait redondant avec celle du controleur )
    }
    protected function prepareForValidation(): void
    {

        $this->merge([
            'duree' => floatval($this->duree),
            'nb_joueur_min' => floatval($this->nb_joueur_min),
            'nb_joueur_max' => floatval($this->nb_joueur_max),
            'max_duree' => floatval($this->route('creneau')->duree),
            'mj' => \Auth::user()->id
        ]);

        //Probablement ajouter la partie qui permet de decider l'heure de depart d'une table :)
    }

    public function messages(): array
    {
        return [
            'duree.lte' => 'La table ne peut pas durée plus longtemps que le creneau, ce creneau dure ' . $this->route('creneau')->duree
        ];
    }
}
