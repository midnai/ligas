<?php

namespace Database\Factories;

use App\Models\Liga;
use Illuminate\Database\Eloquent\Factories\Factory;

class LigaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Liga::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'pais' => 'Perú',
            'cantidad_fechas' => $this->faker->randomNumber(2),
            'fecha_inicio' => now(),
            'fecha_fin' => $this->faker->dateTimeBetween('now', '+1 years')
        ];
    }
}
