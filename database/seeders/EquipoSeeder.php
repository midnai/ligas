<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equipo;
use App\Models\Jugador;

class EquipoSeeder extends Seeder
{

    public function run()
    {
        $equipos = [
            'Academia Cantolao',
            'Alianza Lima',
            'Alianza Universidad',
            'Atlético Grau',
            'Ayacucho FC',
            'Carlos A. Mannucci',
            'Carlos Stein',
            'Cienciano del Cusco',
            'Cusco FC',
            'César Vallejo',
            'Deportivo Binacional',
            'Deportivo Llacuabamba',
            'Deportivo Municipal',
            'Melgar',
            'San Martin',
            'Sport Boys',
            'Sport Huancayo',
            'Sporting Cristal',
            'UTC',
            'Universitario'
        ];

        foreach ($equipos as $value) {
            Equipo::factory()->create([
                'nombre' => $value,
                'logo' => 'https://ui-avatars.com/api/?name='.urlencode($value).'&color=7F9CF5&background=EBF4FF',
            ]);
        }

        $jugadores = Jugador::all();

        Equipo::all()->each(function ($equipos) use (&$jugadores) {
            $equipos->jugadores()->saveMany(
                $jugadores->splice(0, 11)
            );
        });
    }
}
