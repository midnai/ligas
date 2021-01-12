<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Liga;
use App\Models\Equipo;

class LigaSeeder extends Seeder
{
    public function run()
    {
        $ligas = [
            'Copa Libertadores',
            'Copa Argentina',
            'Serie A de Brasil',
            'Copa Do Brasil',
            'Campeonato Paulista',
            'Copa Colombia',
            'Copa Chile',
            'Liga1 de Perú',
            'Copa Sudamericana',
            'Primera Nacional de Argentina',
            'Serie B Brasil',
            'Campeonato Carioca',
            'Liga de Colombia',
            'Campeonato Chileno',
            'LigaPro de Ecuador',
            'Liga Profesional Boliviana'
        ];

        foreach ($ligas as $value) {
            Liga::factory()->create(['nombre' => $value]);
        }

        $equipos = Equipo::all();

        Liga::all()->each(function ($liga) use ($equipos) {
            $liga->equipos()->attach(
                $equipos->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
