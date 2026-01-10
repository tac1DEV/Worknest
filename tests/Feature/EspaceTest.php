<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Espace;
use App\Models\Categorie;
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
        $response->assertStatus(200);
        $response->assertViewHas('espacesUsers', function ($collection) use ($espace) {
            return $collection->contains($espace);
        });
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


}
