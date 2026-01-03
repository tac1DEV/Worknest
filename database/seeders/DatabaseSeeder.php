<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Categorie;
use App\Models\Espace;
use App\Models\Reservation;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'username' => 'Test User',
                'password' => 'password',
                'role' => 'admin',
            ]
        );
        $categories = ['Standard', 'Premium', 'VIP'];
        $prix = [10, 45, 100];

        foreach ($categories as $index => $nom) {
            Categorie::create([
                'nom_categorie' => $nom,
                'prix' => $prix[$index],
            ]);
        }

        User::factory(10)->create();
        Espace::factory(10)->create();
        Reservation::factory(10)->create();
    }
}
