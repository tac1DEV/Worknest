<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Espace;
use PHPUnit\Framework\Attributes\Test;


class EspaceTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_displays_list_of_espaces()
    {
        $espace = Espace::factory()->create();
        $response = $this->get('/espaces');
        $response->assertStatus(200);
        $response->assertSee($espace->name);
    }

    #[Test]
    public function it_displays_espace_details_in_list()
    {
        $espace = Espace::factory()->create();
        $response = $this->get('/espaces');
        $response->assertSee($espace->name)
            ->assertSee((string) $espace->capacity)
            ->assertSee((string) $espace->price);
    }

    #[Test]
    public function it_can_filter_espaces_by_capacity()
    {
        $small = Espace::factory()->create(['capacite' => 50]);
        $medium = Espace::factory()->create(['capacite' => 75]);
        $large = Espace::factory()->create(['capacite' => 100]);
        $response = $this->get('/espaces?filter[capacite]=100');
        $response->assertViewHas('espaces', function ($espaces) use ($large) {
            return $espaces->first()->id === $large->id;
        });
    }

}
