<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{

    public function definition()
    {

        return [

            'day' => $this->faker->randomElement([0, 1, 2, 3, 4]),
            'active' => $this->faker->randomElement([1, 1]),
            'morning_start' => $this->faker->time('H:i:s'),
            'morning_end' =>  $this->faker->time('H:i:s'),
            'afternoon_start' => $this->faker->time('H:i:s'),
            'afternoon_end' => $this->faker->time('H:i:s'),
            'person_id' => Person::whereHas('user', function ($query) {
                $query->whereHas('roles', function ($query) {
                    $query->where('name', '=', 'doctor');
                });
            })->inRandomOrder()->first()->id,
        ];
    }
}
