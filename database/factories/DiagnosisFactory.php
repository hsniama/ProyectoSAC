<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diagnosis>
 */
class DiagnosisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'appointment_id' => Appointment::where('status', 'Atendido')->inRandomOrder()->first()->id,
            'allergies' => fake()->text(),
            'current_medication' => fake()->text(),
            'drug_use' => fake()->randomElement(['Si', 'No']),
            'alcohol_use' => fake()->randomElement(['Si', 'No']),
            'smoking_use' => fake()->randomElement(['Si', 'No']),
            'family_background' => fake()->text(),
            'surgical_history' => fake()->text(),
            'reason_for_consultation' => fake()->text(),
            'conclusions' => fake()->text(),
        ];
    }
}
