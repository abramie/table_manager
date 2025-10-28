<?php

namespace Database\Factories;

use App\Models\Compte;
use App\Models\Creneau;
use App\Models\Jeu;
use App\Models\Table;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
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
            'description' => $this->faker->sentence(40,true),
            'duree' => $this->faker->numberBetween(2,5),
            'debut_table' => $this->faker->dateTimeBetween('now', '+1 year'),
            'sans_table'=> false,
            'nb_joueur_min' => $this->faker->numberBetween(2,3),
            'nb_joueur_max' => $this->faker->numberBetween(3,5),
            'mj' => Profile::factory()->mj(),
            'creneau_id' => Creneau::factory(),
            'jeu_id' => Jeu::factory(),
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterMaking(function (Table $table) {
            // ...
        })->afterCreating(function (Table $table) {
            // ...
            $users = Profile::get()->random(rand($table->nb_joueur_min,$table->nb_joueur_max));
            $table->inscrits()->sync($users);

        });
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
