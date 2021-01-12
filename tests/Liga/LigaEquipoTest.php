<?php

namespace Tests\Liga;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use App\Models\Liga;
use App\Models\User;
use App\Models\Equipo;
use Tests\TestCase;

class LigaEquipoTest extends TestCase
{

    use RefreshDatabase;

    public function test_lista_de_equipos_que_pertenecen_a_una_liga()
    {
        $liga = Liga::factory()->create([
            'nombre' => 'Primera Liga',
        ]);

        $equipo1 = Equipo::factory()->create([
            'nombre' => 'Equipo 1',
        ]);

        $equipo2 = Equipo::factory()->create([
            'nombre' => 'Equipo 2',
        ]);

        $liga->equipos()->attach($equipo1->id);
        $liga->equipos()->attach($equipo2->id);

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/ligas/'.$liga->id.'/equipos')
            ->assertOk()
            ->assertJson([
                'data' => [
                    [ 'nombre' => 'Equipo 1' ],
                    [ 'nombre' => 'Equipo 2' ]
                ]
            ]);
    }
}
