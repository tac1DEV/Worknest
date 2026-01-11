<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Espace;

class UserTest extends TestCase
{
    use RefreshDatabase;


    public function test_admin_peut_acceder_aux_pages_admin(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get('/admin/espaces');

        $response->assertStatus(200);
    }


    public function test_client_ne_peut_pas_acceder_aux_pages_admin(): void
    {
        $client = User::factory()->create([
            'role' => 'client',
        ]);

        $response = $this->actingAs($client)->get('/admin/espaces');

        $response->assertStatus(403);
    }


    public function test_utilisateur_non_connecte_ne_peut_pas_acceder_aux_pages_protegees(): void
    {
        $espace = Espace::factory()->create([
            'nom' => 'John Doe',
            'disponible' => 1,
            'capacite' => 100,
            'ecran' => 1,
            'tableau_blanc' => 0,
        ]);
        $response = $this->get('/espaces/' . $espace->id);
        $response->assertRedirect(route('login')); // redirection vers login
    }


    public function test_role_est_correctement_attribue_lors_de_la_creation(): void
    {
        $client = User::factory()->create(['role' => 'client']);

        $this->assertEquals('client', $client->role);
    }
}
