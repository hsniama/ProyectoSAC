<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'cedula' => fake()->unique()->randomNumber(8),
            'apellidos' => fake()->lastName(),
            'nombres' => fake()->firstName(),
            'telefono' => preg_replace('/[^0-9]/', '', fake()->unique()->numerify('##########')),
            'direccion' => fake()->address(),
            'ciudad' => fake()->randomElement(['Quito', 'Guayaquil', 'Cuenca', 'Manta']),
            'fecha_nacimiento' => fake()->dateTimeBetween('1950-01-01', '2022-12-31')->format('Y-m-d'),
            'genero' => fake()->randomElement(['Masculino', 'Femenino', 'Otro']),
        ];
    }
}
