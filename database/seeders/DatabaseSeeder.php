<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Categorie;
use App\Models\Espace;
use App\Models\Reservation;
use App\Models\Schedule;
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
        $users = [
            [
                'email' => 'admin@mail.com',
                'name' => 'Admin User',
                'password' => 'password',
                'role' => 'admin'
            ],
            [
                'email' => 'test@mail.com',
                'name' => 'Test User',
                'password' => 'password',
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['email' => $user['email']],
                $user
            );
        }



        User::factory(10)->create();
        Espace::factory(10)->create();
        Schedule::factory(10)->create();
    }
}
