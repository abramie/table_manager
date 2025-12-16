<?php

namespace Database\Factories;

use App\Models\Compte;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'compte_id' => Compte::factory(),
            //
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterMaking(function (Profile $profile) {
            $profile->order =  $profile->compte->profiles()->count() +1;

        });
    }

    public function mj(): Factory {
        return $this->state(function (array $attributes) {
            return [
            ];
        })->afterMaking(function (Profile $profile) {
            $profile->compte->assignRole('joueur','mj');
            // ...
        })->afterCreating(function (Profile $profile) {

            // ...
        });
    }
}
