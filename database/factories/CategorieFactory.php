<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategorieFactory extends Factory
{
    protected $model = Categorie::class;

    public function definition(): array
    {
        $categories = ['Standard', 'Premium', 'VIP'];
        $prix = [10, 45, 100];

        $index = $this->faker->numberBetween(0, 2);

        return [
            'nom_categorie' => $categories[$index],
            'prix' => $prix[$index],
        ];
    }
}
