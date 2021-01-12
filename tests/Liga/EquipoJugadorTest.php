<?php

namespace Tests\Liga;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use App\Models\Jugador;
use App\Models\User;
use App\Models\Equipo;
use Tests\TestCase;

class EquipoJugadorTest extends TestCase
{
    use RefreshDatabase;

    public function test_lista_de_jugadores_que_pertenecen_a_un_equipo()
    {
        $equipo = Equipo::factory()->create([
            'nombre' => 'Equipo X',
        ]);

        $jugador1 = Jugador::factory()->create([
            'nombre' => 'Jugador 1',
        ]);

        $jugador2 = Jugador::factory()->create([
            'nombre' => 'Jugador 2',
        ]);

        $jugador1->equipo()->associate($equipo)->save();
        $jugador2->equipo()->associate($equipo)->save();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/equipos/'.$equipo->id.'/jugadores')
            ->assertOk()
            ->assertJson([
                'data' => [
                    [ 'nombre' => 'Jugador 1' ],
                    [ 'nombre' => 'Jugador 2' ]
                ]
            ]);
    }
}
