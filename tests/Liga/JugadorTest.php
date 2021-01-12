<?php

namespace Tests\Liga;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use App\Models\Jugador;
use App\Models\Equipo;
use App\Models\User;
use Tests\TestCase;

class JugadorTest extends TestCase
{
    use RefreshDatabase;

    public function test_jugador_no_pudo_ser_creado_correctamente()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $data = [];

        $this->json('POST', '/api/jugadores', $data)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'nombre' => ['The nombre field is required.']
                ]
            ]);
    }

    public function test_jugador_es_creado_correctamente()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $data = [
            'nombre' => 'Jugador Falso',
        ];

        $this->json('POST', '/api/jugadores', $data)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'nombre' => 'Jugador Falso'
                ]
            ]);
    }

    public function test_jugador_es_actualizado_correctamente()
    {
        $jugador = Jugador::factory()->create([
            'nombre' => 'Jugador X',
        ]);

        $equipo = Equipo::factory()->create([
            'nombre' => 'Equipo X',
        ]);

        $data = [
            'equipo_id' => $equipo->id,
        ];

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $this->json('PUT', '/api/jugadores/'.$jugador->id, $data)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'nombre' => 'Jugador X'
                ]
            ]);

        $this->get('/api/jugadores/' . $jugador->id)
            ->assertOk()
            ->assertJson([
                'data' => [
                    'nombre' => 'Jugador X'
                ]
            ]);

        $this->get('/api/equipos/'.$equipo->id.'/jugadores')
            ->assertOk()
            ->assertJson([
                'data' => [
                    [ 'nombre' => 'Jugador X' ]
                ]
            ]);
    }

    public function test_jugador_es_eliminado_correctamente()
    {
        $jugador = Jugador::factory()->create([
            'nombre' => 'Primera Jugador',
        ]);

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $this->json('DELETE', '/api/jugadores/' . $jugador->id, [])
            ->assertStatus(204);
    }

    public function test_jugador_es_obtenido_exitosamente()
    {
        $jugador = Jugador::factory()->create([
            'nombre' => 'Jugador 1',
        ]);

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/jugadores/' . $jugador->id)
            ->assertOk()
            ->assertJson([
                'data' => [
                    'nombre' => 'Jugador 1'
                ]
            ]);
    }

    public function test_lista_jugadores_es_obtenido_correctamente()
    {
        Jugador::factory()->create([
            'nombre' => 'Primer Jugador',
        ]);
        Jugador::factory()->create([
            'nombre' => 'Segundo Jugador',
        ]);

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/jugadores')
            ->assertOk()
            ->assertJson([
                'data' => [
                    [ 'nombre' => 'Primer Jugador' ],
                    [ 'nombre' => 'Segundo Jugador' ]
                ]
            ]);
    }
}
