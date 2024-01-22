<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TableFactory extends Factory
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
            'duree' => $this->faker->numberBetween(2,5),
            'debut_table' => $this->faker->dateTimeBetween('now', '+1 year'),
            'sans_table'=> false,
            'nb_joueur_min' => $this->faker->numberBetween(2,3),
            'nb_joueur_max' => $this->faker->numberBetween(3,5),
            'mj_id' => User::factory(),
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
