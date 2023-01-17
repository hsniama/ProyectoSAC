<?php

namespace Database\Factories;

use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Speciality>
 */
class SpecialityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->unique()->jobTitle(),
            'description' => fake()->sentence(15),
            'status' => fake()->randomElement(['Activo', 'Activo']),
            'created_by' => fake()->name(), 
            'updated_by' => fake()->name(),
        ];
    }
}
