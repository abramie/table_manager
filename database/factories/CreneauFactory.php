<?php

namespace Database\Factories;

use App\Models\Evenement;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CreneauFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nom = $this->faker->sentence(2,true);
        return [
            'nom' =>$nom,
            'description' => $this->faker->sentence(6,true),
            'max_tables' => $this->faker->numberBetween(2,10),
            'nb_inscription_online_max' => $this->faker->numberBetween(0,5),
            'duree' => $this->faker->numberBetween(2,5),
            'debut_creneau' => $this->faker->dateTimeBetween('now', '+1 year'),
            'sans_table'=> false,
            'evenement_id' => Evenement::factory(),
        ];
    }

    /**
     * Indicate that the model's should be sans table
     *
     * @return $this
     */
    public function sans_table(): static
    {
        return $this->state(fn (array $attributes) => [
            'sans_table' => true,
        ]);
    }

}
