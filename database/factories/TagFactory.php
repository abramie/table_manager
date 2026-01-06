<?php

namespace Database\Factories;

use App\Models\Creneau;
use App\Models\Table;
use App\Models\Profile;
use App\Models\types\TypeTag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'nom' =>$this->faker->sentence(2,true),
            'type_tag_id' => TypeTag::findCode('BASE')->id,
        ];
    }

    public function tw(): static
    {
        return $this->state(fn (array $attributes) => [
            'type_tag_id' => TypeTag::findCode('TW')->id,
        ]);
    }





}
