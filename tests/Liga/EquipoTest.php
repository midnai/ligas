<?php

namespace Tests\Liga;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use App\Models\Liga;
use App\Models\Equipo;
use App\Models\User;
use Tests\TestCase;

class EquipoTest extends TestCase
{
    use RefreshDatabase;

    public function test_equipo_no_pudo_ser_creado_correctamente()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $data = [];

        $this->json('POST', '/api/equipos', $data)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'nombre' => ['The nombre field is required.']
                ]
            ]);
    }

    public function test_equipo_es_creado_correctamente()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $data = [
            'nombre' => 'Lorem Ipsum',
        ];

        $this->json('POST', '/api/equipos', $data)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'nombre' => 'Lorem Ipsum'
                ]
            ]);
    }

    public function test_equipo_es_eliminado_correctamente()
    {
        $equipo = Equipo::factory()->create([
            'nombre' => 'Equipo 1',
        ]);

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $this->json('DELETE', '/api/equipos/' . $equipo->id, [])
            ->assertStatus(204);
    }

    public function test_equipo_es_obtenido_exitosamente()
    {
        $equipo = Equipo::factory()->create([
            'nombre' => 'Equipo 1',
        ]);

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/equipos/' . $equipo->id)
            ->assertOk()
            ->assertJson([
                'data' => [
                    'nombre' => 'Equipo 1'
                ]
            ]);
    }

    public function test_lista_equipos_es_obtenido_correctamente()
    {
        Equipo::factory()->create([
            'nombre' => 'Equipo 1',
        ]);
        Equipo::factory()->create([
            'nombre' => 'Equipo 2',
        ]);

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/equipos')
            ->assertOk()
            ->assertJson([
                'data' => [
                    [ 'nombre' => 'Equipo 1' ],
                    [ 'nombre' => 'Equipo 2' ]
                ]
            ]);
    }

}
