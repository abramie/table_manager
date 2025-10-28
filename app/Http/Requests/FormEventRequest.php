<?php

namespace App\Http\Requests;

use App\Models\Settings;
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
            'date_debut' => ['required', 'date', 'after:today'],
            'ouverture_inscription' =>['required', 'date'],
            'fermeture_inscription' =>['required', 'date'],
            'affichage_evenement' =>['required', 'date', 'before_or_equal:date_debut'],
            'description' => [],


        ];
    }
///'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

    protected function prepareForValidation()
    {
        $settings = Settings::whereIn('name',  ['ouverture_inscriptions_avant_date','fermeture_inscriptions_avant_date' ,'visibiliter_avant_date'])->get();
        $date_debut = Carbon::create($this->date_debut);

        $ouverture_inscription = $this->ouverture_inscription ?Carbon::create($this->ouverture_inscription) : $date_debut->copy()->subDays( $settings->firstWhere('name', 'ouverture_inscriptions_avant_date')->value);
        $fermeture_inscription = $this->fermeture_inscription ?Carbon::create($this->fermeture_inscription ):$date_debut->copy()->subDays($settings->firstWhere('name', 'fermeture_inscriptions_avant_date')->value);
        $affichage_evenement = $this->affichage_evenement ?Carbon::create($this->affichage_evenement ):$date_debut->copy()->subDays($settings->firstWhere('name', 'visibiliter_avant_date')->value);
        //Produit un slug valide en cas d'absence.

        $this->merge([
            'slug' => $this->input('slug') ?: Str::slug($this->input('nom_evenement')),
            'max_tables' => floatval($this->max_tables),
            'nb_inscription_online_max' => floatval($this->nb_inscription_online_max),
            'date_debut' => $date_debut,
            'ouverture_inscription' => $ouverture_inscription,
            'fermeture_inscription' => $fermeture_inscription,
            'affichage_evenement' => $affichage_evenement,
        ]);



    }
}
