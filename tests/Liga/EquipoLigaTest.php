<?php

namespace Tests\Liga;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use App\Models\Liga;
use App\Models\User;
use App\Models\Equipo;
use Tests\TestCase;

class EquipoLigaTest extends TestCase
{
    use RefreshDatabase;

    public function test_lista_de_ligas_que_pertenecen_a_un_equipo()
    {
        $equipo = Equipo::factory()->create([
            'nombre' => 'Equipo X',
        ]);

        $liga1 = Liga::factory()->create([
            'nombre' => 'Liga 1',
        ]);

        $liga2 = Liga::factory()->create([
            'nombre' => 'Liga 2',
        ]);

        $equipo->ligas()->attach($liga1->id);
        $equipo->ligas()->attach($liga2->id);

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->get('/api/equipos/'.$equipo->id.'/ligas')
            ->assertOk()
            ->assertJson([
                'data' => [
                    [ 'nombre' => 'Liga 1' ],
                    [ 'nombre' => 'Liga 2' ]
                ]
            ]);
    }
}
