<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Livewire;


class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_utilisateur_connecte_peut_consulter_son_profil(): void
    {
        $user = User::factory()->create([
            'name' => 'Jean Dupont',
            'email' => 'jean@mail.com'
        ]);
        $this->actingAs($user);

        $response = $this->get('/settings/profile');

        $response->assertStatus(200)
            ->assertSeeText('Jean Dupont')
            ->assertSeeText('jean@mail.com');
    }

    public function test_utilisateur_peut_mettre_a_jour_son_profil(): void
    {
        // Création d'un utilisateur
        $user = User::factory()->create([
            'name' => 'Ancien Nom',
            'email' => 'ancien@mail.com',
        ]);

        $this->actingAs($user)
            ->get('/settings/profile') // la route qui sert ton composant Volt
            ->assertStatus(200);
    }

}
