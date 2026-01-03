<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Espace>
 */
class EspaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->name(),
            'disponible' => rand(0, 1),
            'categories_id' => rand(1, 6),
            'surface' => rand(20, 1000),
            'ecran' => rand(0, 1),
            'tableau_blanc' => rand(0, 1),
        ];
    }
}
