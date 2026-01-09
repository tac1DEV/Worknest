<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dateDebut = now()->addSeconds(random_int(1, 604800));
        $color = ['#ff0000', '#00ff00', '#0000ff'];
        $title = ['Meeting', 'Conférence', 'Réunion du comité', 'Brainstorming'];

        return [
            'title' => $title[array_rand($title)],
            'start' => $dateDebut,
            'end' => $dateDebut->copy()->addHour(),
            'color' => $color[array_rand($color)],
            'user_id' => rand(1, 6),
            'espace_id' => rand(1, 6),
        ];
    }
}
