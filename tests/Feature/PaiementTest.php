<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Espace;
use App\Models\Schedule;
use App\Models\Categorie;

class PaiementTest extends TestCase
{
    use RefreshDatabase;


    public function test_le_paiement_declenche_une_redirection_stripe()
    {
        $user = \App\Models\User::factory()->create();

        // Connecte l'utilisateur
        $this->actingAs($user);

        $this->mock(\App\Services\StripeService::class, function ($mock) {
            $mock->shouldReceive('createCheckout')
                ->once()
                ->with([
                    'title' => 'Salle Atlas',
                    'price' => 45,
                ])
                ->andReturn('https://stripe.test/checkout-session');
        });

        $response = $this->get('/stripe/payment?price=45&title=Salle%20Atlas');

        $this->assertTrue(auth()->check());
        $response->assertRedirect('https://stripe.test/checkout-session');
    }

    public function test_le_montant_affiche_correspond_au_prix_de_lespace()
    {
        $categorie = Categorie::factory()->create(['prix' => 10]);
        $user = User::factory()->create();
        $this->actingAs($user);

        $espace = Espace::factory()->create(['categorie_id' => $categorie->id]);

        $schedule = Schedule::factory()->create([
            'espace_id' => $espace->id,
            'user_id' => $user->id,
        ]);

        $response = $this->get('/stripe');

        $response->assertStatus(200)
            ->assertSee('45');
    }

    public function test_annulation_apres_paiement_refuse()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $schedule = Schedule::factory()->create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        $response = $this->get('/stripe/cancel?schedule=' . $schedule->id);

        $response->assertRedirect('/stripe');

        $this->assertDatabaseHas('schedules', [
            'id' => $schedule->id,
            'status' => 'cancelled',
        ]);
    }


    public function test_gestion_des_erreurs_du_service_de_paiement()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/stripe/payment?price=abc&title=test');

        $response->assertStatus(400)
            ->assertSee('Erreur de paiement');
    }

}
