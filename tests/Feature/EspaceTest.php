<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Espace;
use App\Models\Categorie;
use App\Models\Schedule;
use PHPUnit\Framework\Attributes\Test;


class EspaceTest extends TestCase
{
    use RefreshDatabase;

    public function test_liste_espaces(): void
    {
        $espace = Espace::factory()->create([
            'nom' => 'John Doe',
            'disponible' => 1,
            'capacite' => 100,
            'ecran' => 1,
            'tableau_blanc' => 0,
        ]);
        $response = $this->get('/espaces');
        $response->assertStatus(200)
            ->assertViewHas('espacesUsers', function ($collection) use ($espace) {
                return $collection->contains($espace);
            });
    }

    public function test_espace_indisponible(): void
    {
        $espace = Espace::factory()->create([
            'nom' => 'PRENOM UNIQUE',
            'disponible' => 0,
            'capacite' => 100,
            'ecran' => 1,
            'tableau_blanc' => 0,
        ]);
        $response = $this->get('/espaces');
        $response->assertStatus(200)
            ->assertViewHas('espacesUsers', function ($collection) use ($espace) {
                return !$collection->contains($espace);
            })
            ->assertDontSee($espace->nom);
    }
    public function test_filtres_espaces_par_capacite()
    {
        $espace50 = Espace::factory()->create([
            'nom' => 'John Doe50',
            'disponible' => 1,
            'capacite' => 50,
            'ecran' => 1,
            'tableau_blanc' => 0,
        ]);

        $espace100 = Espace::factory()->create([
            'nom' => 'John Doe100',
            'disponible' => 1,
            'capacite' => 100,
            'ecran' => 1,
            'tableau_blanc' => 0,
        ]);
        $response = $this->get('/espaces?filter[capacite]=100');
        $response
            ->assertSee($espace100->nom)
            ->assertSee($espace100->capacite)
            ->assertSee($espace100->prix)
            ->assertDontSee($espace50->nom)
            ->assertViewHas('espacesUsers', function ($collection) use ($espace100) {
                return $collection->contains($espace100);
            });
    }

    public function test_filtres_espaces_par_equipement_tableau()
    {
        $espace_tableau = Espace::factory()->create([
            'nom' => 'John Avec',
            'disponible' => 1,
            'capacite' => 50,
            'ecran' => 1,
            'tableau_blanc' => 1,
        ]);

        $espace_rien = Espace::factory()->create([
            'nom' => 'John Sans',
            'disponible' => 1,
            'capacite' => 75,
            'ecran' => 1,
            'tableau_blanc' => 0,
        ]);
        $response = $this->get('/espaces?filter[tableau_blanc]=1');
        $response
            ->assertSee($espace_tableau->nom)
            ->assertSee($espace_tableau->capacite)
            ->assertSee($espace_tableau->prix)
            ->assertDontSee($espace_rien->nom)
            ->assertViewHas('espacesUsers', function ($collection) use ($espace_tableau) {
                return $collection->contains($espace_tableau);
            });
    }

    public function test_filtres_espaces_par_equipement_ecran()
    {
        $espace_ecran = Espace::factory()->create([
            'nom' => 'John Avec',
            'disponible' => 1,
            'capacite' => 50,
            'ecran' => 1,
            'tableau_blanc' => 1,
        ]);

        $espace_rien = Espace::factory()->create([
            'nom' => 'John Sans',
            'disponible' => 1,
            'capacite' => 75,
            'ecran' => 0,
            'tableau_blanc' => 0,
        ]);
        $response = $this->get('/espaces?filter[tableau_blanc]=1');
        $response
            ->assertSee($espace_ecran->nom)
            ->assertSee($espace_ecran->capacite)
            ->assertSee($espace_ecran->prix)
            ->assertDontSee($espace_rien->nom)
            ->assertViewHas('espacesUsers', function ($collection) use ($espace_ecran) {
                return $collection->contains($espace_ecran);
            });
    }

    public function test_filtres_espaces_par_prix()
    {

        $catChere = Categorie::factory()->create(['prix' => 100]);
        $catPasChere = Categorie::factory()->create(['prix' => 10]);

        $espace_pas_cher = Espace::factory()->create([
            'nom' => 'John Pauvre',
            'disponible' => 1,
            'capacite' => 50,
            'ecran' => 1,
            'tableau_blanc' => 1,
            'categorie_id' => $catPasChere->id,
        ]);

        $espace_cher = Espace::factory()->create([
            'nom' => 'John Riche',
            'disponible' => 1,
            'capacite' => 75,
            'ecran' => 0,
            'tableau_blanc' => 0,
            'categorie_id' => $catChere->id,
        ]);

        $response = $this->get('/espaces?filter[categorie.prix]=10');
        $response
            ->assertSee($espace_pas_cher->nom)
            ->assertSee($espace_pas_cher->capacite)
            ->assertSee($espace_pas_cher->prix)
            ->assertDontSee($espace_cher->nom)
            ->assertViewHas('espacesUsers', function ($collection) use ($espace_pas_cher) {
                return $collection->contains($espace_pas_cher);
            });
    }

    public function test_anonyme_ne_peut_pas_consulter_un_espace()
    {
        $espace = Espace::factory()->create([
            'nom' => 'Salle Atlas',
            'capacite' => 50,
        ]);

        $response = $this->get("/espaces/{$espace->id}");

        $response->assertStatus(302);
    }

    public function test_utilisateur_connecte_peut_consulter_un_espace()
    {
        $user = \App\Models\User::factory()->create();

        // Connecte l'utilisateur
        $this->actingAs($user);

        $espace = Espace::factory()->create([
            'nom' => 'Salle Atlas',
            'capacite' => 50,
        ]);

        $response = $this->get("/espaces/{$espace->id}");

        $this->assertTrue(auth()->check());
        $response->assertStatus(200);
    }

    public function test_la_page_affiche_les_informations_completes_de_lespace()
    {
        $user = \App\Models\User::factory()->create();
        // Connecte l'utilisateur
        $this->actingAs($user);

        $espace = Espace::factory()->create([
            'nom' => 'Salle Atlas',
            'disponible' => 1,
            'capacite' => 50,
            'ecran' => 1,
            'tableau_blanc' => 1,
        ]);

        $response = $this->get("/espaces/{$espace->id}");

        $this->assertTrue(auth()->check());
        $response->assertStatus(200)
            ->assertViewIs('espaces.show')
            ->assertViewHas('espace', function ($viewEspace) use ($espace) {
                return $viewEspace->id === $espace->id
                    && $viewEspace->nom === $espace->nom
                    && $viewEspace->capacite === $espace->capacite
                    && $viewEspace->ecran === $espace->ecran
                    && $viewEspace->tableau_blanc === $espace->tableau_blanc;
            });
    }

    public function test_la_page_affiche_le_planning_de_disponibilite()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $espace = Espace::factory()->create();

        $planning = Schedule::factory()->create([
            'espace_id' => $espace->id,
            'user_id' => $user->id,
        ]);

        $response = $this->get("/espaces/{$espace->id}/calendar");

        $response->assertStatus(200)
            ->assertViewHas('espace', $espace)
            ->assertViewHas('schedules', function ($schedules) use ($planning) {
                return $schedules->contains(function ($s) use ($planning) {
                    return $s->id === $planning->id;
                });
            });

        $this->assertTrue(auth()->check());
    }

    public function test_un_identifiant_inexistant_retourne_une_404()
    {
        $user = \App\Models\User::factory()->create();
        // Connecte l'utilisateur
        $this->actingAs($user);
        $response = $this->get('/espaces/999999');

        $this->assertTrue(auth()->check());
        $response->assertStatus(404);
    }

    public function test_redirection_si_anonyme()
    {
        $espace = Espace::factory()->create();

        // Aucun actingAs()
        $response = $this->get("/espaces/{$espace->id}");
        $response->assertStatus(302);
    }
}
