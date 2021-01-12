<?php

namespace Database\Factories;

use App\Models\Equipo;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Equipo::class;

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
            'pais' => $this->faker->randomElement(['Perú', 'Argentina', 'Ecuador']),
            'ciudad' => $this->faker->city,
            'direccion' => $this->faker->streetAddress,
            'telefono' => $this->faker->phoneNumber,
            'estadio' => $this->faker->city,
            'pagina_web' => '',
            'logo' => 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF',
            'fecha_fundacion' => $this->faker->dateTimeBetween('-100 years', '-25 years')
        ];
    }
}
