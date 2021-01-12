<?php

namespace Database\Factories;

use App\Models\Jugador;
use Illuminate\Database\Eloquent\Factories\Factory;

class JugadorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Jugador::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;

        return [
            'nombre' => $name,
            'foto' => 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF',
            'posicion' => $this->faker->randomElement(['Arquero', 'Mediocampo', 'Defensa', 'Atacante']),
            'seleccion' => $this->faker->randomElement(['Perú', 'Argentina', 'Ecuador']),
            'nacionalidad' => $this->faker->randomElement(['Perú', 'Argentina', 'Ecuador']),
            'total_goles' => $this->faker->randomNumber(2),
            'peso' => $this->faker->numberBetween(68, 85) . '.00' ,
            'altura' => '1.' . $this->faker->numberBetween(68, 85),
            'nacimiento' => $this->faker->dateTimeBetween('-30 years', '-19 years'),
            'debut' => $this->faker->dateTimeBetween('-30 years', '-19 years')
        ];
    }
}
