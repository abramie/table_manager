<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class EvenementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $start = $this->faker->dateTimeBetween('now', '+1 year');
        $nom_evenement = $this->faker->sentence(2,true);
        return [
            'nom_evenement' =>$nom_evenement ,
            'slug' => Str::slug($nom_evenement),
            'description' => $this->faker->sentence(6,true),
            'max_tables' => $this->faker->numberBetween(2,10),
            'nb_inscription_online_max' => $this->faker->numberBetween(0,15),
            'date_debut' => $start,
            'affichage_evenement' => $this->faker->dateTimeBetween("-month", $start),
            'ouverture_inscription' => $this->faker->dateTimeBetween("now", $start),
            'fermeture_inscription' => $this->faker->dateTimeBetween("ouverture_inscription", $start),
            'archivage' => null,
        ];
    }
    /**
     * Créer un evenement où la date precedete le present.
     *
     * @return $this
     */
    public function afficher(): static{

        return $this->state(fn (array $attributes) => [
            'affichage_evenement' => Carbon::yesterday(),
        ]);

    }

    /**
     * Indicate that the model's should be sans table
     *
     * @return $this
     */
    public function inscriptions_ouvertes(): static
    {
        $start = $this->faker->dateTimeBetween('now', '+3 months');
        return $this->state(fn (array $attributes) => [
            'date_debut' => $start,
            'ouverture_inscription' => Carbon::yesterday(),
            'fermeture_inscription' => $start,
        ]);
    }

}
