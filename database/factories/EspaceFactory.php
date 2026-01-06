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
        $capacite = [50, 75, 100];

        return [
            'nom' => fake()->name(),
            'disponible' => rand(0, 1),
            'capacite' => $capacite[array_rand($capacite)],
            'ecran' => rand(0, 1),
            'tableau_blanc' => rand(0, 1),
            'categorie_id' => rand(1, 3),
        ];
    }
}
