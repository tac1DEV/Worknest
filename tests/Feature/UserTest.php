<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Espace;
use App\Models\Schedule;

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

    public function test_utilisateur_connecte_peut_acceder_a_l_historique_des_reservations(): void
    {
        $espace = Espace::factory()->create();
        $user = User::factory()->create();
        $schedule = Schedule::factory()->create([
            'espace_id' => $espace->id,
            'user_id' => $user->id,
        ]);
        $this->actingAs($user);


        $response = $this->get(route('profile.reservations'));

        $response->assertStatus(200)
            ->assertSee('Début de la réservation')
            ->assertSee('Fin de la réservation')
            ->assertSee('Utilisateur')
            ->assertSee('Espace')
            ->assertSee('Modifier')
            ->assertSee('Facture');
    }


    public function test_utilisateur_connecte_peut_acceder_a_une_facture(): void
    {
        $espace = Espace::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);

        $schedule = Schedule::factory()->create([
            'espace_id' => $espace->id,
            'user_id' => $user->id,
        ]);

        $expectedUri = '/facture/' . $schedule->id;
        $actualUri = route('reservation.facture', $schedule, false); // false = URI relative

        $this->assertEquals($expectedUri, $actualUri);

        // Accès à la page
        $response = $this->get($expectedUri);

        $response->assertStatus(200);
    }


    public function test_page_reservations_affiche_un_message_quand_aucune_reservation(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('profile.reservations'));

        $response->assertStatus(200)
            ->assertSee('Aucune réservation pour le moment'); // Vérifie qu'un message s'affiche si vide
    }


}
