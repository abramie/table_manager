<?php

namespace App\Http\Requests;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;


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
            'mj' => ['required'],
            'debut_table' => ['required', 'date', 'after_or_equal:debut_creneau']


            //Ajout verification clef etrangere que l'event existe bien ?
        ];

        //Ajout regle pour verification jeu https://www.youtube.com/watch?v=zy6ByXZ9DZ4&list=PLjwdMgw5TTLXz1GRhKxSWYyDHwVW-gqrm&index=12 vers 27 minutes
        //Ajout regle validation nombre de tables ? (qui serait redondant avec celle du controleur )
    }
    protected function prepareForValidation(): void
    {
        if( $this->mj_name && \Auth::user()->can('manage_tables_all') ){
            $mj = User::get()->where('name', $this->mj_name)->first();
            if($mj == null){
              throw ValidationException::withMessages([
                  'mj_name' => "Le Mj n'existe pas",

              ]);
            }
        }else {
            $mj = \Auth::user();
        }
        $creneau = $this->route('creneau');

        //$date = $creneau->debut_creneau->
        $this->merge([
            'duree' => floatval($this->duree),
            'nb_joueur_min' => floatval($this->nb_joueur_min),
            'nb_joueur_max' => floatval($this->nb_joueur_max),
            'max_duree' => floatval($creneau->duree),
            'mj' => $mj->id,
            'debut_creneau' => $creneau->debut_creneau,
            'debut_table' => $creneau->debut_creneau->setTimeFromTimeString($this->debut_table),
        ]);
        //Combien de temps après le debut du creneau la table doit commencer
        $diffHour = $this->debut_table->diffInHours($this->route('creneau')->debut_creneau);
        //dd($diffHour);
        if($diffHour+$this->duree > $creneau->duree){
            throw ValidationException::withMessages([
                'erreur_temps' => "La partie ne peut pas exceder l'heure de fin du creneau, reduiser la durée de celle ci",

            ]);
        }

        //Probablement ajouter la partie qui permet de decider l'heure de depart d'une table :)
    }

    public function messages(): array
    {
        return [
            'duree.lte' => 'La table ne peut pas durée plus longtemps que le creneau, ce creneau dure ' . $this->route('creneau')->duree
        ];
    }
}
