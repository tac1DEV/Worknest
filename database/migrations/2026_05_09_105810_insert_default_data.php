<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        // Users
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@mail.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        DB::table('users')->updateOrInsert(
            ['email' => 'test@mail.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'role' => 'client',
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        // Categories
        DB::table('categories')->updateOrInsert(
            ['nom_categorie' => 'Standard'],
            [
                'prix' => 10,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        DB::table('categories')->updateOrInsert(
            ['nom_categorie' => 'Premium'],
            [
                'prix' => 45,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );

        DB::table('categories')->updateOrInsert(
            ['nom_categorie' => 'VIP'],
            [
                'prix' => 100,
                'updated_at' => now(),
                'created_at' => now(),
            ]
        );
    }

    public function down(): void
    {
        //
    }
};
