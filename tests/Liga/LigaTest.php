<?php

namespace Tests\Liga;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use App\Models\Liga;
use App\Models\User;
use App\Models\Equipo;
use Tests\TestCase;

class LigaTest extends TestCase
{
    use RefreshDatabase;

    public function test_liga_no_pudo_ser_creado_correctamente()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $data = [];

        $this->json('POST', '/api/ligas', $data)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'nombre' => ['The nombre field is required.']
                ]
            ]);
    }

    public function test_liga_es_creado_correctamente()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $data = [
            'nombre' => 'Lorem Ipsum',
        ];

        $this->json('POST', '/api/ligas', $data)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'nombre' => 'Lorem Ipsum'
                ]
            ]);
    }

    public function test_liga_es_eliminado_correctamente()
    {
        $liga = Liga::factory()->create([
            'nombre' => 'Primera Liga',
        ]);

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $this->json('DELETE', '/api/ligas/' . $liga->id, [])
            ->assertStatus(204);
    }

    public function test_liga_es_obtenido_exitosamente()
    {
        $liga = Liga::factory()->create([
            'nombre' => 'Primera Liga',
        ]);

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/ligas/' . $liga->id)
            ->assertOk()
            ->assertJson([
                'data' => [
                    'nombre' => 'Primera Liga'
                ]
            ]);
    }

    public function test_lista_ligas_es_obtenido_correctamente()
    {
        Liga::factory()->create([
            'nombre' => 'Primera Liga',
        ]);
        Liga::factory()->create([
            'nombre' => 'Segunda Liga',
        ]);

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/ligas')
            ->assertOk()
            ->assertJson([
                'data' => [
                    [ 'nombre' => 'Primera Liga' ],
                    [ 'nombre' => 'Segunda Liga' ]
                ]
            ]);
    }
}
