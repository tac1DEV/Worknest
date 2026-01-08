<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dateDebut = now()->addSeconds(random_int(1, 604800));
        return [
            'date_debut' => $dateDebut,
            'date_fin' => $dateDebut->copy()->addHour(),
            'users_id' => rand(1, 6),
            'espaces_id' => rand(1, 6),
        ];
    }
}
